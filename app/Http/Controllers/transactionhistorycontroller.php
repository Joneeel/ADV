<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class transactionhistorycontroller extends Controller
{

    public function searchhistory(Request $request){
        try {

            $this->validate($request, [
                'searchhistory' => 'required',
            ]);
    
            $searchhistory = $request->input('searchhistory');
    
            $name = session('uniname');
            $searchhistory = DB::table('historys')->select('*')->where('Book_id','=', $searchhistory)->get();
            if(!$name == null){
                return view('transactionhistory',['message' => 'Searched Successfully!','name' => $name, 'historys' => $searchhistory]);
            }
            else {
                return view('login',['message' => 'Error!']);
            }

        } catch (\Exception $e) {
            $name = session('uniname');
            $history = DB::table('historys')->select('*')->get();
            return view('transactionhistory',['message' => 'Searched Successfully!','name' => $name, 'historys' => $history]);
        }
    }

}
