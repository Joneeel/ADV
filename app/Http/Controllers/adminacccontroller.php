<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class adminacccontroller extends Controller
{
    public function changepassadmin(Request $request){

        try
      {  
        $name = session('uniname');
            if(!$name == null){

            $this->validate($request, [
                'currentpassword' => 'required',
                'newpassword' => 'required',
                'confirmnewpassword' => 'required|same:newpassword|required_with:newpassword',
            ]);
    
            $currentpassword = DB::table('adminaccs')->where('name',$name)->pluck('password')->first();

            $inputcurrentpassword = $request->input('currentpassword');
            $newpassword = $request->input('newpassword');

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

            if($currentpassword == $inputcurrentpassword){
                DB::table('adminaccs')->where('name',$name )->update(['password' => $newpassword]);
                return view('dashboard',['message' => 'Change Password Successfully',
                'name' => $name,
                'acccount' => $acccount,
                'bookcount' => $bookcount,
                'borrowercount' => $borrowercount, 
                'historycount' => $historycount,
                'transactioncount' => $transactionscount,
                'notreturnedcount' => $notreturnedcount ]);
            }
            else{
                return view('dashboard',['message' => 'Change Password Failed, Please Try Again Later!',
                'name' => $name,
                'acccount' => $acccount,
                'bookcount' => $bookcount,
                'borrowercount' => $borrowercount, 
                'historycount' => $historycount,
                'transactioncount' => $transactionscount,
                'notreturnedcount' => $notreturnedcount ]);
            }
            
        }
        else {
            $request->session()->flush();
            return view('login',['message' => 'Error!']);
        } 

    }
    catch (\Exception $e){
        $name = session('uniname');

        $inputcurrentpassword = $request->input('currentpassword');
        $newpassword = $request->input('newpassword');

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

        return view('dashboard',['message' => 'Error Occured! Please Try Again Later...',
        'name' => $name,
        'acccount' => $acccount,
        'bookcount' => $bookcount,
        'borrowercount' => $borrowercount, 
        'historycount' => $historycount,
        'transactioncount' => $transactionscount,
        'notreturnedcount' => $notreturnedcount ]);
    }


    }

    public function displaychangepass(){
    try {
        $name = session('uniname');
        if(!$name == null){
            return view('accchangepass',['name' => $name]);
        }
        else {
            $request->session()->flush();
            return view('login',['message' => 'Error!']);
        } 
    } catch (\Exception $e) {
        $name = session('uniname');
        return view('dashboard',['message' => 'Error Occured! Please Try Again Later...','name' => $name]);
    }
    }
}
