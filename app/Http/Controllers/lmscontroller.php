<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class lmscontroller extends Controller
{
    public function books(){
        try{
            $name = session('uniname');
            $books = DB::table('books')->select('*')->where('status','=','Active')->paginate(6);
            $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
            if(!$name == null){
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            $request->session()->flush();
            return view('login',['message' => 'Error Occured in Accessing Books! Please Try Again Later...']);
        }

    }

    public function login(){
        return view('login',['message' => '']);
    }

    public function signup(){
        return view('signup',['message' => '']);
    }

    public function dashboard(){
        try {        
    
     $name = session('uniname');

     $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
     $bna = $borrowernotactive->count();

     $book = DB::table('books')->select('*')->where('status','=','Active')->get();
     $bookcount = $book->count();

     $borrower = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->get();
     $borrowercount = $borrower->count();

     $history = DB::table('historys')->select('*')->get();
     $historycount = $history->count();

     $transactions = DB::table('transactions')->select('*')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->get(); // not due
     $transactionscount = $transactions->count();

     $notreturned = DB::table('transactions')->select('*')->whereDate('DueDateReturned','<', \Carbon\Carbon::now())->get(); // due
     $notreturnedcount = $notreturned->count();

     $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
     $ab = $archivebooks->count();

        if(!$name == null){
            return view('dashboard',            
            ['bna' => $bna,
            'bookcount' => $bookcount,
            'borrowercount' => $borrowercount, 
            'historycount' => $historycount,
            'transactioncount' => $transactionscount,
            'notreturnedcount' => $notreturnedcount,
            'ab'=> $ab, 
            'name' => $name]);
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        $request->session()->flush();
        return view('login',['message' => 'Error Occured in Accessing Dashboard! Please Try Again Later...']);
    }

    }

    public function borrower(){
    try {
        $name = session('uniname');
        $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->paginate(6);
        $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
        if(!$name == null){
            return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        $request->session()->flush();
        return view('login',['message' => 'Error Occured in Accessing Borrower Page! Please Try Again Later...']);
    }
    }

    public function notreturnedbooks(){
        try {
        $name = session('uniname');
        $notreturned = DB::table('transactions')->select('*')->whereDate('DueDateReturned','<', \Carbon\Carbon::now())->paginate(6); // due
        if(!$name == null){
            return view('notreturnedbooks',['message' => '','name' => $name, 'notreturned' => $notreturned]);
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        $request->session()->flush();
        return view('login',['message' => 'Error Occured in Accessing NotReturnedPage! Please Try Again Later...']);
    }
    }

    public function borrow(){
        try {
        $name = session('uniname');
        $transactions = DB::table('transactions')->select('*')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->paginate(6); // not due
        if(!$name == null){
            return view('borrow',['message' => '','name' => $name, 'issuebookborrow' => $transactions]);
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        $request->session()->flush();
        return view('login',['message' => 'Error Occured in Accessing Borrow Page! Please Try Again Later...']);
    }
    }

    public function transactionhistory(){
        try {
        $name = session('uniname');
        $historys = DB::table('historys')->select('*')->paginate(6);
        if(!$name == null){
            return view('transactionhistory',['message' => '','name' => $name , 'historys' => $historys]);
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        $request->session()->flush();
        return view('login',['message' => 'Error Occured in accessing Transaction History! Please Try Again Later...']);
    }
    }


    public function logout(Request $request){
        try {
        $request->session()->flush();
        return view('login',['message' => 'Log Out Successfully!']);
    } catch (\Exception $e) {
        return view('login',['message' => 'Error Occured! Please Try Again Later...']);
    }
    }



    public function loginvalidation(Request $request){

        try {
//////////////////////////////////////////////////////////////////////////////////////////////////////////

        $request->session()->flush();
///////////////////////////////////////////////////////////////////////////////// Sorter Table Books
        $request->session()->put('sortstatus1books', '');
        $request->session()->put('sortstatus2books', '');
        $request->session()->put('sortstatus3books', '');
        $request->session()->put('sortstatus4books', '');
        $request->session()->put('sortstatus5books', '');
        $request->session()->put('sortstatus6books', '');
        $request->session()->put('sortstatus7books', '');
        $request->session()->put('sortstatus8books', '');
///////////////////////////////////////////////////////////////////////////////// Sorter Table Books

///////////////////////////////////////////////////////////////////////////////// Sorter Table Borrower
        $request->session()->put('sortstatus1borrower', '');
        $request->session()->put('sortstatus2borrower', '');
        $request->session()->put('sortstatus3borrower', '');
        $request->session()->put('sortstatus4borrower', '');
        $request->session()->put('sortstatus5borrower', '');
        $request->session()->put('sortstatus6borrower', '');
        $request->session()->put('sortstatus7borrower', '');
        $request->session()->put('sortstatus8borrower', '');
///////////////////////////////////////////////////////////////////////////////// Sorter Table Borrower

        $now = \Carbon\Carbon::now();

        DB::table('borrowers')->where('resetmonth', '!=' ,$now->month)->where('Status','=','Active')->update(['vio_count' => 0, 'resetmonth' => $now->month]);
        
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

     $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
     $bna = $borrowernotactive->count();

     $book = DB::table('books')->select('*')->where('status','=','Active')->get();
     $bookcount = $book->count();

     $borrower = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->get();
     $borrowercount = $borrower->count();

     $history = DB::table('historys')->select('*')->get();
     $historycount = $history->count();

     $transactions = DB::table('transactions')->select('*')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->get(); // not due
     $transactionscount = $transactions->count();

     $notreturned = DB::table('transactions')->select('*')->whereDate('DueDateReturned','<', \Carbon\Carbon::now())->get(); // due
     $notreturnedcount = $notreturned->count();

     $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
     $ab = $archivebooks->count();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
     $user = DB::table('adminaccs')->where('username', '=', $username)->where('password', '=', $password)->where('status', '=' , 'Y')->get();
     $usercount = $user->count();
     $name = DB::table('adminaccs')->select('name')->where('username', '=' ,$username)->where('password', '=', $password)->pluck('name')->first();
     $request->session()->put('uniname', $name);

        if (!$usercount == 0) {

            return view('dashboard',
            ['bna' => $bna,
            'bookcount' => $bookcount,
            'borrowercount' => $borrowercount, 
            'historycount' => $historycount,
            'transactioncount' => $transactionscount,
            'notreturnedcount' => $notreturnedcount, 
            'ab'=> $ab,
            'name' => $name]);
        }
        else {
            $request->session()->flush();
            return view('login', ['message' => 'Invalid Credentials! or Your account is currently not set active!']);
        }

    } catch (\Exception $e) {
            return view('login',['message' => 'Error Occured! Please Try Again Later...']);
        }

    }

    public function signupvalidation(Request $request){

        try
            {   
                
            $this->validate($request, [
                'name' => 'required',
                'username' => 'required',
                'password' => 'required|same:password_confirmation|required_with:password_confirmation',
                'password_confirmation' => 'required'
            ]);

            $name = $request->input('name');
            $username = $request->input('username');
            $password = $request->input('password');
            $data=array('name'=>$name,"username"=>$username,"password"=>$password, "status" => "N","created_at" =>  \Carbon\Carbon::now(),"updated_at" => \Carbon\Carbon::now());
            DB::table('adminaccs')->insert($data);

            return view('login',['message' => 'Registered Successfully!']);
    }
    catch (\Exception $e){
        return view('signup',['message' => 'Username/Name is already taken! OR Password and Confirmed Password are not the same!']);
    }
            
               
          

    }

}
