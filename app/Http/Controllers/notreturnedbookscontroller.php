<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class notreturnedbookscontroller extends Controller
{

/**
 * It gets the book id, borrower id, and date borrowed of the transaction id passed to it, then it
 * increments the borrower's violation count by 1, adds 1 to the book's stock, inserts the data to the
 * history table, deletes the transaction, and redirects to the not returned books page with a success
 * message.
 * 
 * @param Transac_id The id of the transaction that is being returned.
 * 
 * @return The book is being returned.
 */
    public function notreturnedbook($Transac_id) {

            $name = session('uniname');
        
            if(!$name == null){
        
             $Book_id = DB::table('transactions')->select('Book_id')->where('Transac_id', $Transac_id)->pluck('Book_id')->first();
             $Borrower_id = DB::table('transactions')->select('Borrower_id')->where('Transac_id', $Transac_id)->pluck('Borrower_id')->first();
             $DateBorrowed = DB::table('transactions')->select('DateBorrowed')->where('Transac_id', $Transac_id)->pluck('DateBorrowed')->first();
             
/* It gets the violation count of the borrower, increments it by 1, and updates the violation count of
the borrower. */
             $viocount = DB::table('borrowers')->where('Borrower_id', $Borrower_id)->value('vio_count');
             $newviocount = $viocount + 1;
             DB::table('borrowers')->where('Borrower_id', $Borrower_id)->update(['vio_count' => $newviocount ,'updated_at' => \Carbon\Carbon::now()]);
             
/* It gets the stock of the book, increments it by 1, and updates the stock of the book. */
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
        
                return redirect()->route('notreturnedbooks')->with('message','Book Successfully Returned');
            }
            else {
                return view('login',['message' => 'Error, Please try again later!']);
            } 

        
    }

/**
 * It searches for the not returned books.
 * 
 * @param Request request This is the request object that contains the data that was sent to the
 * controller.
 * 
 * @return The searchnotreturned function is being returned.
 */
    public function searchnotreturned(Request $request){
        try {

            $this->validate($request, [
                'searchnotreturned' => 'required',
            ]);
    
            $searchnotreturned = $request->input('searchnotreturned');
    
            $name = session('uniname');
            $searchnotreturned = DB::table('transactions')->select('*')->where('Fullname','like', '%'.$searchnotreturned.'%')->whereDate('DueDateReturned','<', \Carbon\Carbon::now())->paginate(6); // due
            if(!$name == null){
                return view('notreturnedbooks',['name' => $name, 'notreturned' => $searchnotreturned]);
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            return redirect()->route('notreturnedbooks')->with('message', 'Error Occured.');
        }
    }


}
