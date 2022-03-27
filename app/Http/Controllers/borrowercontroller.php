<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class borrowercontroller extends Controller
{
    public function create(Request $request) {
        $name = session('uniname');

        if(!$name == null){
            $this->validate($request, [
                'fullname' => 'required',
                'gender' => 'required',
                'address' => 'required',
            ]);

            $fullname = $request->input('fullname');
            $gender = $request->input('gender');
            $address = $request->input('address');


            $data=array(
                'fullname'=>$fullname,
                "gender"=>$gender,
                "address"=>$address,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now());

            DB::table('borrowers')->insert($data);
            
            $borrowers = DB::table('borrowers')->select('*')->get();
    
            return view('borrower',['name' => $name,'borrowers' => $borrowers]);
            }
            else {
                return view('login',['message' => 'Error!']);
            } 
    }

    public function edit(Request $request) {

        $name = session('uniname');

        if(!$name == null){
            $this->validate($request, [
                'fullname' => 'required',
                'gender' => 'required',
                'address' => 'required',
            ]);

            $Borrower_id = $request->input('Borrower_id');
            $fullname = $request->input('fullname');
            $gender = $request->input('gender');
            $address = $request->input('address');

            DB::table('borrowers')->where('Borrower_id', $Borrower_id)->update(['fullname' => $fullname ,'gender' => $gender,'address' => $address,'updated_at' => \Carbon\Carbon::now()]);
            $borrowers = DB::table('borrowers')->select('*')->get();
    
            return view('borrower',['name' => $name,'borrowers' => $borrowers]);
        }
        else {
            return view('login',['message' => 'Error!']);
        } 
    }

    public function delete($Borrower_id) {
        $name = session('uniname');

        if(!$name == null){
            DB::table('borrowers')->where('Borrower_id', $Borrower_id)->delete();
            return redirect()->route('borrower');
        }
        else {
            return view('login',['message' => 'Error!']);
        } 
    }

    public function createdisplay() {
        $name = session('uniname');
        if(!$name == null){
            return view('borrower.create',['name' => $name]);
        }
        else {
            return view('login',['message' => 'Error!']);
        } 
    }

    public function editdisplay($Borrower_id) {

        $name = session('uniname');

        if(!$name == null){

            $fullname = DB::table('borrowers')->select('fullname')->where('Borrower_id', $Borrower_id)->pluck('fullname')->first();
            $gender = DB::table('borrowers')->select('gender')->where('Borrower_id', $Borrower_id)->pluck('gender')->first();
            $address = DB::table('borrowers')->select('address')->where('Borrower_id', $Borrower_id)->pluck('address')->first();
                
            return view('borrower.edit', ['name' => $name,'Borrower_id' => $Borrower_id,'fullname' => $fullname,'gender' => $gender,'address' => $address]);
            
        }

        else {
            return view('login',['message' => 'Error!']);
        } 
    }

}
