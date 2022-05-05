<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class borrowcontroller extends Controller
{
/**
 * This function is used to issue a book to a borrower
 * 
 * @param Request request This is the request object that contains the data that was submitted to the
 * form.
 * 
 * @return the view of the borrow page.
 */
    public function issue(Request $request) {
        try {

        $name = session('uniname');

        if(!$name == null){
            
            $this->validate($request, [
                'borrower_id' => 'required',
                'book_id' => 'required',
                'days' => 'required',
            ]);

            $Borrower_id = $request->input('borrower_id');
            $Book_id = $request->input('book_id');
            $borrowdate = \Carbon\Carbon::parse($request->input('days'));
            $borrowreturn = \Carbon\Carbon::now();

/* This is used to get the difference of the date that the user inputted and the current date. */
            $result = $borrowreturn->diffInDays($borrowdate, false);
            $result = $result+1;

            $BookTitle = DB::table('books')->select('Title')->where('Book_id', $Book_id)->pluck('Title')->first();
            $Fullname = DB::table('borrowers')->select('fullname')->where('Borrower_id', $Borrower_id)->pluck('fullname')->first();

/* This is used to check if the user had already the book. */
            $transac = DB::table('transactions')->where('Borrower_id', '=', $Borrower_id)->where('Book_id', '=', $Book_id)->get();
            $transacount = $transac->count();

            if ($transacount == 0){

            $Stock = DB::table('books')->where('Book_id', $Book_id)->value('Stock');
            
            if (!$Stock == 0){
                $data=array(
                    'Book_id'=> $Book_id,
                    "Borrower_id"=> $Borrower_id,
                    "DateBorrowed"=> \Carbon\Carbon::now(),
                    "DueDateReturned"=> \Carbon\Carbon::now()->addDays($result),
                    "Fullname"=>$Fullname,
                    "BookTitle"=>$BookTitle,
                    "created_at" =>  \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now());
    
                DB::table('transactions')->insert($data);
                $newstock = $Stock - 1;
                DB::table('books')->where('Book_id', $Book_id)->update(['Stock' => $newstock]);

                return redirect()->route('borrow')->with('message', 'Successfully Issued.');
            }
            else {
                return redirect()->route('borrow')->with('message', 'This book is out of stock');
            }

            }

            else{
                return redirect()->route('borrow')->with('message', 'This user had already the book');
            } 

            }

            else {
                
                return view('login',['message' => 'Error!']);
            } 

        } catch (\Exception $e) {
            return redirect()->route('borrow')->with('message', 'Error Occured! Please Try Again Later...');
        }

    }

/**
 * It deletes the transaction from the transactions table and inserts the data into the history table.
 * 
 * @param Transac_id The id of the transaction that is being returned.
 * 
 * @return The book is being returned.
 */
    public function returned($Transac_id) {
        try {
    $name = session('uniname');

    if(!$name == null){

     $Book_id = DB::table('transactions')->select('Book_id')->where('Transac_id', $Transac_id)->pluck('Book_id')->first();
     $Borrower_id = DB::table('transactions')->select('Borrower_id')->where('Transac_id', $Transac_id)->pluck('Borrower_id')->first();
     $DateBorrowed = DB::table('transactions')->select('DateBorrowed')->where('Transac_id', $Transac_id)->pluck('DateBorrowed')->first();

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

        return redirect()->route('borrow')->with('message', 'Book Successfully Returned');
    }
    else {
        return view('login',['message' => 'Error!']);
    } 

} catch (\Exception $e) {
    return redirect()->route('borrow')->with('message', 'Error Occured! Please Try Again Later...');
}


    }

/**
 * This function is used to display the issue page.
 * 
 * @return the view of the issue page.
 */
    public function issuedisplay() {
        $name = session('uniname');

        if(!$name == null){
            $borrower = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->get();
            $books = DB::table('books')->select('*')->where('status', '=' , 'Active')->get();
            return view('borrow.issue',['name' => $name, 'borrower' => $borrower, 'books' => $books]);
        }
        else {
            return view('login',['message' => 'Error!']);
        } 
    }

/**
 * This function is used to search for a book that is not yet due
 * 
 * @param Request request The request object.
 * 
 * @return The searchissue function is being returned.
 */
    public function searchissue(Request $request){
        
        try {

            $this->validate($request, [
                'searchissue' => 'required',
            ]);
    
            $searchissue = $request->input('searchissue');
    
            $name = session('uniname');
            $searchissue = DB::table('transactions')->select('*')->where('Fullname','like', '%'.$searchissue.'%')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->paginate(6); // not due
            
            if(!$name == null){
                return view('borrow',['message' => 'Searched Successfully!','name' => $name, 'issuebookborrow' => $searchissue]);
            }
            else {
                return view('login',['message' => 'Error!']);
            }
            
        } catch (\Exception $e) {
            return view('login',['message' => 'Error!']);
        }
    }



}
