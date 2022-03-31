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
        try {
        $name = session('uniname');
        $books = DB::table('books')->select('*')->get();
        if(!$name == null){
            return view('books',['message' => '','name' => $name, 'books' => $books]);
        }
        else {
            $request->session()->flush();
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return view('login',['message' => 'Error Occured in Accessing Book Page! Please Try Again Later...']);
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

     $acc = DB::table('adminaccs')->select('*')->get();
     $acccount = $acc->count();

     $book = DB::table('books')->select('*')->get();
     $bookcount = $book->count();

     $borrower = DB::table('borrowers')->select('*')->get();
     $borrowercount = $borrower->count();

     $history = DB::table('historys')->select('*')->get();
     $historycount = $history->count();

     $transactions = DB::table('transactions')->select('*')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->get(); // not due
     $transactionscount = $transactions->count();

     $notreturned = DB::table('transactions')->select('*')->whereDate('DueDateReturned','<', \Carbon\Carbon::now())->get(); // due
     $notreturnedcount = $notreturned->count();

        if(!$name == null){
            return view('dashboard',            
            ['acccount' => $acccount,
            'bookcount' => $bookcount,
            'borrowercount' => $borrowercount, 
            'historycount' => $historycount,
            'transactioncount' => $transactionscount,
            'notreturnedcount' => $notreturnedcount, 
            'name' => $name]);
        }
        else {
            $request->session()->flush();
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return view('login',['message' => 'Error Occured in Accessing Dashboard! Please Try Again Later...']);
    }

    }

    public function borrower(){
    try {
        $name = session('uniname');
        $borrower = DB::table('borrowers')->select('*')->get();
        if(!$name == null){
            return view('borrower',['message' => '','borrowers' => $borrower,'name' => $name]);
        }
        else {
            $request->session()->flush();
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return view('login',['message' => 'Error Occured in Accessing Borrower Page! Please Try Again Later...']);
    }
    }

    public function notreturnedbooks(){
        try {
        $name = session('uniname');
        $notreturned = DB::table('transactions')->select('*')->whereDate('DueDateReturned','<', \Carbon\Carbon::now())->get(); // due
        if(!$name == null){
            return view('notreturnedbooks',['message' => '','name' => $name, 'notreturned' => $notreturned]);
        }
        else {
            $request->session()->flush();
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return view('login',['message' => 'Error Occured in Accessing NotReturnedPage! Please Try Again Later...']);
    }
    }

    public function borrow(){
        try {
        $name = session('uniname');
        $transactions = DB::table('transactions')->select('*')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->get(); // not due
        if(!$name == null){
            return view('borrow',['message' => '','name' => $name, 'issuebookborrow' => $transactions]);
        }
        else {
            $request->session()->flush();
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return view('login',['message' => 'Error Occured in Accessing Borrow Page! Please Try Again Later...']);
    }
    }

    public function transactionhistory(){
        try {
        $name = session('uniname');
        $historys = DB::table('historys')->select('*')->get();
        if(!$name == null){
            return view('transactionhistory',['message' => '','name' => $name , 'historys' => $historys]);
        }
        else {
            $request->session()->flush();
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
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

        $now = \Carbon\Carbon::now();

        DB::table('borrowers')->where('resetmonth', '!=' ,$now->month)->update(['vio_count' => 0, 'resetmonth' => $now->month]);
        
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

     $acc = DB::table('adminaccs')->select('*')->get();
     $acccount = $acc->count();
     $request->session()->put('uniacccount', $acccount);

     $book = DB::table('books')->select('*')->get();
     $bookcount = $book->count();
     $request->session()->put('unibookcount', $bookcount);

     $borrower = DB::table('borrowers')->select('*')->get();
     $borrowercount = $borrower->count();
     $request->session()->put('uniborrowercount', $borrowercount);

     $history = DB::table('historys')->select('*')->get();
     $historycount = $history->count();
     $request->session()->put('unihistorycount', $historycount);

     $transactions = DB::table('transactions')->select('*')->whereDate('DueDateReturned','>=', \Carbon\Carbon::now())->get(); // not due
     $transactionscount = $transactions->count();
     $request->session()->put('unitransactionscount', $transactionscount);

     $notreturned = DB::table('transactions')->select('*')->whereDate('DueDateReturned','<', \Carbon\Carbon::now())->get(); // due
     $notreturnedcount = $notreturned->count();
     $request->session()->put('uninotreturnedcount', $notreturnedcount);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
     $user = DB::table('adminaccs')->where('username', '=', $username)->where('password', '=', $password)->where('status', '=' , 'Y')->get();
     $usercount = $user->count();
     $name = DB::table('adminaccs')->select('name')->where('username', '=' ,$username)->where('password', '=', $password)->pluck('name')->first();
     $request->session()->put('uniname', $name);

        if (!$usercount == 0) {
            return view('dashboard',
            ['acccount' => $acccount,
            'bookcount' => $bookcount,
            'borrowercount' => $borrowercount, 
            'historycount' => $historycount,
            'transactioncount' => $transactionscount,
            'notreturnedcount' => $notreturnedcount, 
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
