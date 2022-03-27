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
        $name = session('uniname');
        $books = DB::table('books')->select('*')->get();
        if(!$name == null){
            return view('books',['name' => $name, 'books' => $books]);
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    }

    public function login(){
        return view('login',['message' => '']);
    }

    public function signup(){
        return view('signup',['message' => '']);
    }

    public function dashboard(){

        $name = session('uniname');
        $acccount = session('uniacccount');
        $bookcount = session('unibookcount');
        $borrowercount = session('uniborrowercount');
        $historycount = session('unihistorycount');
        $transactionscount = session('unitransactionscount');
        $notreturnedcount = session('uninotreturnedcount');

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
            return view('login',['message' => 'Error!']);
        }

    }

    public function borrower(){
        $name = session('uniname');
        $borrower = DB::table('borrowers')->select('*')->get();
        if(!$name == null){
            return view('borrower',['borrowers' => $borrower,'name' => $name]);
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    }

    public function notreturnedbooks(){
        $name = session('uniname');
        $notreturned = DB::table('transactions')->select('*')->where('DueDateReturned','<', \Carbon\Carbon::now())->get();
        if(!$name == null){
            return view('notreturnedbooks',['name' => $name, 'notreturned' => $notreturned]);
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    }

    public function borrow(){
        $name = session('uniname');
        $transactions = DB::table('transactions')->select('*')->get();
        if(!$name == null){
            return view('borrow',['name' => $name, 'issuebookborrow' => $transactions]);
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    }

    public function transactionhistory(){
        $name = session('uniname');
        $historys = DB::table('historys')->select('*')->get();
        if(!$name == null){
            return view('transactionhistory',['name' => $name , 'historys' => $historys]);
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return view('login',['message' => 'Log Out Successfully!']);
    }

    public function loginvalidation(Request $request){
//////////////////////////////////////////////////////////////////////////////////////////////////////////
        $request->session()->flush();
        
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

     $transactions = DB::table('transactions')->select('*')->get();
     $transactionscount = $transactions->count();
     $request->session()->put('unitransactionscount', $transactionscount);

     $notreturned = DB::table('transactions')->select('*')->where('DueDateReturned','>=', \Carbon\Carbon::now())->get();
     $notreturnedcount = $notreturned->count();
     $request->session()->put('uninotreturnedcount', $notreturnedcount);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
     $user = DB::table('adminaccs')->where('username', '=', $username)->where('password', '=', $password)->get();
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
            return view('login', ['message' => 'Invalid Credentials!']);
        }

    }
    public function signupvalidation(Request $request){
        
        try {

            $this->validate($request, [
                'name' => 'required',
                'username' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required|same:password'
            ]);

            $name = $request->input('name');
            $username = $request->input('username');
            $password = $request->input('password');
            $data=array('name'=>$name,"username"=>$username,"password"=>$password,"created_at" =>  \Carbon\Carbon::now(),"updated_at" => \Carbon\Carbon::now());
            DB::table('adminaccs')->insert($data);
    
            return view('login',['message' => 'Registered Successfully!']);
          
          } catch (\Exception $e) {
          
              return view('signup',['message' => 'Username/Name Already Exist']);
          }


    }

}
