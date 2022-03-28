<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class notreturnedbookscontroller extends Controller
{

    public function returned($Transac_id) {

        try {
            $name = session('uniname');
        
            if(!$name == null){
        
             $Book_id = DB::table('transactions')->select('Book_id')->where('Transac_id', $Transac_id)->pluck('Book_id')->first();
             $Borrower_id = DB::table('transactions')->select('Borrower_id')->where('Transac_id', $Transac_id)->pluck('Borrower_id')->first();
             $DateBorrowed = DB::table('transactions')->select('DateBorrowed')->where('Transac_id', $Transac_id)->pluck('DateBorrowed')->first();
             
             $viocount = DB::table('borrowers')->where('Borrower_id', $Borrower_id)->value('vio_count');
             $newviocount = $viocount + 1;
             DB::table('borrowers')->where('Borrower_id', $Borrower_id)->update(['vio_count' => $fullname ,'updated_at' => \Carbon\Carbon::now()]);
             
             $Stock = DB::table('books')->where('Book_id', $Book_id)->value('Stock');
             $newstock = $Stock + 1;
             DB::table('books')->where('Book_id', $Book_id)->update(['Stock' => $newstock]);
        
             $data = array(
                 'Book_id' => $Book_id,
                 'Borrower_id' => $Borrower_id,
                 'Date_Returned' => \Carbon\Carbon::now(),
                 'Date_Borrowed' => $DateBorrowed,
                 'created_at' => \Carbon\Carbon::now(),
                 'updated_at' => \Carbon\Carbon::now(),
             );
        
             DB::table('historys')->insert($data);
        
                DB::table('transactions')->where('Transac_id', $Transac_id)->delete();
        
                $transactions = DB::table('transactions')->select('*')->get();
        
                return view('borrow',['message' => 'Book Successfully Returned','name' => $name,'issuebookborrow' => $transactions]);
            }
            else {
                return view('login',['message' => 'Error!']);
            } 
        
        } catch (\Exception $e) {
            $name = session('uniname');
            $transactions = DB::table('transactions')->select('*')->get();
            return view('borrow',['message' => 'Error Occured! Please Try Again Later...','name' => $name,'issuebookborrow' => $transactions]);
        }
        
    }


}
