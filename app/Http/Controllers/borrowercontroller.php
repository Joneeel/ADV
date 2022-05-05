<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class borrowercontroller extends Controller
{
/**
 * This function is used to create a new borrower
 * 
 * @param Request request The request object.
 * 
 * @return the view of the borrower page with the message "Successfully Created!"
 */
    public function create(Request $request) {
        try {
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
            $now = \Carbon\Carbon::now();

            $data=array(
                "fullname"=>$fullname,
                "gender"=>$gender,
                "status"=> "Active",
                "address"=> $address,
                "vio_count"=> 0 ,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
                "resetmonth" => $now->month);

            DB::table('borrowers')->insert($data);
    
            return redirect()->route('borrower')->with('message', 'Successfully Created!');
            }
            else {
                return view('login',['message' => 'Error!']);
            } 
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message', 'Error Occured.');
        }
    }

/**
 * This function is used to edit the borrower's information
 * 
 * @param Request request This is the request object that contains all the information about the
 * request.
 * 
 * @return the view of the borrower page.
 */
    public function edit(Request $request) {
        try {
        $name = session('uniname');

        if(!$name == null){
            $this->validate($request, [
                'fullname' => 'required',
                'vio' => 'required',
                'gender' => 'required',
                'address' => 'required',
            ]);

            $Borrower_id = $request->input('Borrower_id');
            $fullname = $request->input('fullname');
            $vio = $request->input('vio');
            $gender = $request->input('gender');
            $address = $request->input('address');

            DB::table('borrowers')->where('Borrower_id', $Borrower_id)->update(['fullname' => $fullname ,'gender' => $gender,'address' => $address,'vio_count' => $vio,'updated_at' => \Carbon\Carbon::now()]);
            return redirect()->route('borrower')->with('message', 'Successfully Edited!');
        }
        else {
            return view('login',['message' => 'Error!']);
        } 
    } catch (\Exception $e) {
        return redirect()->route('borrower')->with('message', 'Error Occured.');
    }
    }

/**
 * It deletes a borrower from the database.
 * 
 * @param Borrower_id The id of the borrower to be deleted.
 * 
 * @return the view of the borrower page with the message "Successfully Deleted."
 */
    public function delete($Borrower_id) {

        try {

        $name = session('uniname');

        if(!$name == null){

            DB::table('borrowers')->where('Borrower_id', $Borrower_id)->delete();
            return redirect()->route('borrower')->with('message2', 'Successfully Deleted.')->with('page', 1);

        }
        else {
            return view('login',['message' => 'Error!']);
        } 
    } catch (\Exception $e) {
        return redirect()->route('borrower')->with('message2', 'Error Occured.')->with('page', 1);
    }

    }


/**
 * This function is used to archive a borrower.
 * 
 * @param Borrower_id The id of the borrower
 * 
 * @return This function is used to archive a borrower.
 */
    public function borrowernotactive($Borrower_id) {

        try {

        $name = session('uniname');

        if(!$name == null){

            $transac = DB::table('transactions')->select('*')->where('Borrower_id', '=' , $Borrower_id)->get();
            $transaccount = $transac->count();

            $viocheck = DB::table('borrowers')->select('*')->where('Borrower_id', '=' , $Borrower_id)->where('vio_count','!=', '0')->where('Status','=','Active')->get();
            $viocheckcount = $viocheck->count();
            
            if ($transaccount == 0) {

                if( $viocheckcount == 0 ){

                    DB::table('transactions')->where('Borrower_id', $Borrower_id)->delete();
                    DB::table('historys')->where('Borrower_id', $Borrower_id)->delete();
                    DB::table('borrowers')->where('Borrower_id', $Borrower_id)->update(['status' => 'NotActive']);
        
        
                    return redirect()->route('borrower')->with('message', 'Successfully Archived.');
                }
                else{
                    return redirect()->route('borrower')->with('message', 'This Still Have Violations!');
                }
            }
            else {
                return redirect()->route('borrower')->with('message', 'This User have not returned book!.');
            }
        }
        else {
            return view('login',['message' => 'Error!']);
        } 
    } catch (\Exception $e) {
        return redirect()->route('borrower')->with('message', 'Error Occured.');
    }

    }


/**
 * This function is used to display the create page for the borrower.
 * 
 * @return The view for the create page is being returned.
 */

    public function createdisplay() {
        $name = session('uniname');
        if(!$name == null){
            return view('borrower.create',['name' => $name]);
        }
        else {
            return view('login',['message' => 'Error!']);
        } 
    }


/**
 * It gets the borrower's information from the database and displays it in the edit page.
 * 
 * @param Borrower_id The id of the borrower to be edited.
 * 
 * @return The editdisplay function is returning the view of the edit page with the borrower's
 * information.
 */
    public function editdisplay($Borrower_id) {

        $name = session('uniname');

        if(!$name == null){

            $fullname = DB::table('borrowers')->select('fullname')->where('Borrower_id', $Borrower_id)->pluck('fullname')->first();
            $gender = DB::table('borrowers')->select('gender')->where('Borrower_id', $Borrower_id)->pluck('gender')->first();
            $address = DB::table('borrowers')->select('address')->where('Borrower_id', $Borrower_id)->pluck('address')->first();
            $vio = DB::table('borrowers')->select('vio_count')->where('Borrower_id', $Borrower_id)->value('vio_count');
                
            return view('borrower.edit', ['name' => $name,'Borrower_id' => $Borrower_id,'fullname' => $fullname,'gender' => $gender,'address' => $address,'vio' => $vio]);
            
        }

        else {
            return view('login',['message' => 'Error!']);
        } 
    }

/**
 * This function is used to search for a borrower in the database.
 * 
 * @param Request request The request object.
 * 
 * @return The searchborroweractive function is being returned.
 */
    public function searchborroweractive(Request $request){
        try {

            $this->validate($request, [
                'searchborroweractive' => 'required',
            ]);
    
            $searchborroweractive = $request->input('searchborroweractive');
    
            $name = session('uniname');
            $searchborrower = DB::table('borrowers')->select('*')->where('fullname','like', '%'.$searchborroweractive.'%')->where('Status', '=' , 'Active')->paginate(6);
            $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
            if(!$name == null){
                return view('borrower',['name' => $name, 'borroweractive' => $searchborrower,'borrowernotactive' => $borrowernotactive,'page' => 0]);
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message', 'Error Occured.');
        }

    }

/**
 * This function is used to search for a borrower in the database
 * 
 * @param Request request This is the request object that contains the data sent by the user.
 * 
 * @return The searchborrowernotactive function is being returned.
 */
    public function searchborrowernotactive(Request $request){
        try {

            $this->validate($request, [
                'searchborrowernotactive' => 'required',
            ]);
    
            $searchborrowernotactive = $request->input('searchborrowernotactive');
    
            $name = session('uniname');
            $searchborrowernotactive = DB::table('borrowers')->select('*')->where('fullname','like', '%'.$searchborrowernotactive.'%')->where('Status', '=' , 'NotActive')->get();
            $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->paginate(6);
            if(!$name == null){
                return view('borrower',['name' => $name, 'borroweractive' => $borroweractive,'borrowernotactive' => $searchborrowernotactive, 'page' => 1]);
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message', 'Error Occured.');
        }
    }


/**
 * It sorts the borrower table by borrower id.
 * 
 * @param Request request The request object.
 * 
 * @return the borrower page with the borrower table sorted by borrower id in ascending order.
 */
    public function borroweridsort(Request $request){
        try{
            $sortstatus1borrower = session('sortstatus1borrower');
            error_log($sortstatus1borrower);
            $name = session('uniname');
            if(!$name == null){
                if($sortstatus1borrower == 'ASC'){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('Borrower_id', 'ASC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'DESC';
                    $request->session()->put('sortstatus1borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
                if($sortstatus1borrower == 'DESC' || $sortstatus1borrower == null ){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('Borrower_id', 'DESC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'ASC';
                    $request->session()->put('sortstatus1borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
        }
    }

/**
 * It sorts the borrower's fullname in ascending or descending order.
 * 
 * @param Request request The request object.
 * 
 * @return It returns the borrower page with the borrower table sorted by fullname in ascending order.
 */
    public function fullnamesort(Request $request){
        try{
            $sortstatus2borrower = session('sortstatus2borrower');
            error_log($sortstatus2borrower);
            $name = session('uniname');
            if(!$name == null){
                if($sortstatus2borrower == 'ASC'){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('fullname', 'ASC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'DESC';
                    $request->session()->put('sortstatus2borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
                if($sortstatus2borrower == 'DESC' || $sortstatus2borrower == null ){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('fullname', 'DESC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'ASC';
                    $request->session()->put('sortstatus2borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
        }
    }

/**
 * It sorts the gender of the borrower in ascending or descending order.
 * 
 * @param Request request The request object.
 * 
 * @return the borrower page with the borrower table sorted by gender.
 */
    public function gendersort(Request $request){
        try{
            $sortstatus3borrower = session('sortstatus3borrower');
            error_log($sortstatus3borrower);
            $name = session('uniname');
            if(!$name == null){
                if($sortstatus3borrower == 'ASC'){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('gender', 'ASC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'DESC';
                    $request->session()->put('sortstatus3borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
                if($sortstatus3borrower == 'DESC' || $sortstatus3borrower == null ){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('gender', 'DESC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'ASC';
                    $request->session()->put('sortstatus3borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
        }
    }

/**
 * This function is used to sort the status of the borrower in ascending or descending order
 * 
 * @param Request request The request object.
 * 
 * @return the borrower page with the borrower table sorted by status.
 */
    public function statussort(Request $request){
        try{
            $sortstatus4borrower = session('sortstatus4borrower');
            error_log($sortstatus4borrower);
            $name = session('uniname');
            if(!$name == null){
                if($sortstatus4borrower == 'ASC'){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('status', 'ASC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'DESC';
                    $request->session()->put('sortstatus4borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
                if($sortstatus4borrower == 'DESC' || $sortstatus4borrower == null ){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('status', 'DESC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'ASC';
                    $request->session()->put('sortstatus4borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
        }
    }

/**
 * It sorts the borrower's address in ascending or descending order.
 * 
 * @param Request request The request object.
 * 
 * @return the borrower page with the borrower table sorted by address.
 */
    public function addresssort(Request $request){
        try{
            $sortstatus5borrower = session('sortstatus5borrower');
            error_log($sortstatus5borrower);
            $name = session('uniname');
            if(!$name == null){
                if($sortstatus5borrower == 'ASC'){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('address', 'ASC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'DESC';
                    $request->session()->put('sortstatus5borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
                if($sortstatus5borrower == 'DESC' || $sortstatus5borrower == null ){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('address', 'DESC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'ASC';
                    $request->session()->put('sortstatus5borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
        }
    }

/**
 * It sorts the borrower table by vio_count in ascending or descending order.
 * 
 * @param Request request The request object.
 * 
 * @return the borrower page with the borrower table sorted by the vio_count in ascending or descending
 * order.
 */
    public function viocountsort(Request $request){
        try{
            $sortstatus6borrower = session('sortstatus6borrower');
            error_log($sortstatus6borrower);
            $name = session('uniname');
            if(!$name == null){
                if($sortstatus6borrower == 'ASC'){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('vio_count', 'ASC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'DESC';
                    $request->session()->put('sortstatus6borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
                if($sortstatus6borrower == 'DESC' || $sortstatus6borrower == null ){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('vio_count', 'DESC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'ASC';
                    $request->session()->put('sortstatus6borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
        }
    }

/**
 * It sorts the borrower table by created_at column.
 * 
 * @param Request request The request object.
 * 
 * @return the borrower page with the borrower table sorted by created_at in ascending order.
 */
    public function createdatsort(Request $request){
        try{
            $sortstatus7borrower = session('sortstatus7borrower');
            error_log($sortstatus7borrower);
            $name = session('uniname');
            if(!$name == null){
                if($sortstatus7borrower == 'ASC'){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('created_at', 'ASC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'DESC';
                    $request->session()->put('sortstatus7borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
                if($sortstatus7borrower == 'DESC' || $sortstatus7borrower == null ){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('created_at', 'DESC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'ASC';
                    $request->session()->put('sortstatus7borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
        }
    }

/**
 * It updates the sort status of the borrower page.
 * 
 * @param Request request The request object.
 * 
 * @return the borrower page with the updated sort status.
 */
    public function updatesort(Request $request){
        try{
            $sortstatus8borrower = session('sortstatus8borrower');
            error_log($sortstatus8borrower);
            $name = session('uniname');
            if(!$name == null){
                if($sortstatus8borrower == 'ASC'){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('updated_at', 'ASC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'DESC';
                    $request->session()->put('sortstatus8borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
                if($sortstatus8borrower == 'DESC' || $sortstatus8borrower == null ){
                    $borroweractive = DB::table('borrowers')->select('*')->where('Status', '=' , 'Active')->orderBy('updated_at', 'DESC')->paginate(6);
                    $borrowernotactive = DB::table('borrowers')->select('*')->where('Status', '=' , 'NotActive')->get();
                    $value = 'ASC';
                    $request->session()->put('sortstatus8borrower', $value);
                     return view('borrower',['message' => '','borroweractive' => $borroweractive,'borrowernotactive' => $borrowernotactive,'name' => $name,'page' => 0]);
                }
            }
            else {
                return view('login',['message' => 'Error!']);
            }
        } catch (\Exception $e) {
            return redirect()->route('borrower')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
        }
    }

}


