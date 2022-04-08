<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class notreturnedbookscontroller extends Controller
{

    public function notreturnedbook($Transac_id) {

            $name = session('uniname');
        
            if(!$name == null){
        
             $Book_id = DB::table('transactions')->select('Book_id')->where('Transac_id', $Transac_id)->pluck('Book_id')->first();
             $Borrower_id = DB::table('transactions')->select('Borrower_id')->where('Transac_id', $Transac_id)->pluck('Borrower_id')->first();
             $DateBorrowed = DB::table('transactions')->select('DateBorrowed')->where('Transac_id', $Transac_id)->pluck('DateBorrowed')->first();
             
             $viocount = DB::table('borrowers')->where('Borrower_id', $Borrower_id)->value('vio_count');
             $newviocount = $viocount + 1;
             DB::table('borrowers')->where('Borrower_id', $Borrower_id)->update(['vio_count' => $newviocount ,'updated_at' => \Carbon\Carbon::now()]);
             
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
        
                $notreturned = DB::table('transactions')->select('*')->whereDate('DueDateReturned','<', \Carbon\Carbon::now())->paginate(6); // due
        
                return view('notreturnedbooks',['message' => 'Book Successfully Returned','name' => $name,'notreturned' => $notreturned]);
            }
            else {
                $request->session()->flush();
                return view('login',['message' => 'Error, Please try again later!']);
            } 

        
    }

    public function searchnotreturned(Request $request){
        try {

            $this->validate($request, [
                'searchnotreturned' => 'required',
            ]);
    
            $searchnotreturned = $request->input('searchnotreturned');
    
            $name = session('uniname');
            $searchnotreturned = DB::table('transactions')->select('*')->where('Fullname','like', '%'.$searchnotreturned.'%')->whereDate('DueDateReturned','<', \Carbon\Carbon::now())->paginate(6); // due
            if(!$name == null){
                return view('notreturnedbooks',['message' => 'Searched Successfully!','name' => $name, 'notreturned' => $searchnotreturned]);
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            $name = session('uniname');
            $notreturned = DB::table('transactions')->select('*')->whereDate('DueDateReturned','<', \Carbon\Carbon::now())->paginate(6); // due
            return view('notreturnedbooks',['message' => 'Error Occured! Please Try Again Later...','name' => $name,'notreturned' => $notreturned]);
        }
    }


}
