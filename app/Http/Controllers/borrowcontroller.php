<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class borrowcontroller extends Controller
{
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
            $days = $request->input('days');

            $BookTitle = DB::table('books')->select('Title')->where('Book_id', $Book_id)->pluck('Title')->first();
            $Fullname = DB::table('borrowers')->select('fullname')->where('Borrower_id', $Borrower_id)->pluck('fullname')->first();

            $transac = DB::table('transactions')->where('Borrower_id', '=', $Borrower_id)->where('Book_id', '=', $Book_id)->get();
            $transacount = $transac->count();

            if ($transacount == 0){

            $Stock = DB::table('books')->where('Book_id', $Book_id)->value('Stock');
            
            if (!$Stock == 0){
                $data=array(
                    'Book_id'=> $Book_id,
                    "Borrower_id"=> $Borrower_id,
                    "DateBorrowed"=> \Carbon\Carbon::now(),
                    "DueDateReturned"=> \Carbon\Carbon::now()->addDays($days),
                    "Fullname"=>$Fullname,
                    "BookTitle"=>$BookTitle,
                    "created_at" =>  \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now());
    
                DB::table('transactions')->insert($data);
                $transactions = DB::table('transactions')->select('*')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->paginate(6); // not due
                $newstock = $Stock - 1;
                DB::table('books')->where('Book_id', $Book_id)->update(['Stock' => $newstock]);
                return view('borrow',['message' => 'Successfully Issued.','name' => $name,'issuebookborrow' => $transactions]);
            }
            else {
                $name = session('uniname');
                $transactions = DB::table('transactions')->select('*')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->paginate(6); // not due
                return view('borrow',['message' => 'This book is out of stock','name' => $name,'issuebookborrow' => $transactions]);
            }

            }

            else{
                $name = session('uniname');
                $transactions = DB::table('transactions')->select('*')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->paginate(6); // not due
                return view('borrow',['message' => 'This user had already the book','name' => $name,'issuebookborrow' => $transactions]);
            } 

            }

            else {
                
                $request->session()->flush();
                return view('login',['message' => 'Error!']);
            } 

        } catch (\Exception $e) {
            $name = session('uniname');
            $transactions = DB::table('transactions')->select('*')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->paginate(6); // not due
            return view('borrow',['message' => 'Error Occured! Please Try Again Later...','name' => $name,'issuebookborrow' => $transactions]);
        }

    }

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

        $transactions = DB::table('transactions')->select('*')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->paginate(6); // not due

        return view('borrow',['message' => 'Book Successfully Returned','name' => $name,'issuebookborrow' => $transactions]);
    }
    else {
        $request->session()->flush();
        return view('login',['message' => 'Error!']);
    } 

} catch (\Exception $e) {
    $name = session('uniname');
    $transactions = DB::table('transactions')->select('*')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->paginate(6); // not due
    return view('borrow',['message' => 'Error Occured! Please Try Again Later...','name' => $name,'issuebookborrow' => $transactions]);
}


    }

    public function issuedisplay() {
        $name = session('uniname');

        if(!$name == null){
            $borrower = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->get();
            $books = DB::table('books')->select('*')->get();
            return view('borrow.issue',['name' => $name, 'borrower' => $borrower, 'books' => $books]);
        }
        else {
            $request->session()->flush();
            return view('login',['message' => 'Error!']);
        } 
    }

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
                $request->session()->flush();
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            $name = session('uniname');
            $transactions = DB::table('transactions')->select('*')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->paginate(6); // not due
            return view('borrow',['message' => 'Error Occured! Please Try Again Later...','name' => $name,'issuebookborrow' => $transactions]);
        }
    }



}
