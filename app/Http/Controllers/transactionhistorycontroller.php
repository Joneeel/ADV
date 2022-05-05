<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class transactionhistorycontroller extends Controller
{

/**
 * This function is used to search the transaction history of a particular book
 * 
 * @param Request request The request object.
 * 
 * @return The searchhistory function is returning the transactionhistory view with the message
 * 'Searched Successfully!' and the name of the user.
 */
    public function searchhistory(Request $request){
        try {

            $this->validate($request, [
                'searchhistory' => 'required',
            ]);
    
            $searchhistory = $request->input('searchhistory');
    
            $name = session('uniname');
            $searchhistory = DB::table('historys')->select('*')->where('Book_id','=', $searchhistory)->paginate(6);
            if(!$name == null){
                return view('transactionhistory',['message' => 'Searched Successfully!','name' => $name, 'historys' => $searchhistory]);
            }
            else {
                return view('login',['message' => 'Error!']);
            }

        } catch (\Exception $e) {
            return redirect()->route('transactionhistory')->with('message', 'Error Occured.');
        }
    }

}
