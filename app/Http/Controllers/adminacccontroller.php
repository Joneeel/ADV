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

            if($currentpassword == $inputcurrentpassword){
                DB::table('adminaccs')->where('name',$name )->update(['password' => $newpassword]);
                return redirect()->route('dashboard')->with('message', 'Change Password Successfully');
            }
            else{
                return redirect()->route('dashboard')->with('message', 'Change Password Failed, Please Try Again Later!');
            }
            
        }
        else {
            $request->session()->flush();
            return view('login',['message' => 'Error!']);
        } 

    }
    catch (\Exception $e){
        return redirect()->route('dashboard')->with('message', 'Error Occured! Please Try Again Later...');
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
