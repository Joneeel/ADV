<?php

namespace App\Http\Controllers;
use App\Models\book;
use Illuminate\Http\Request;
use DB;

class bookcontroller extends Controller
{
    public function create(Request $request) {
        try {
        $name = session('uniname');

        if(!$name == null){
            $this->validate($request, [
                'Title' => 'required',
                'Author' => 'required',
                'Copyright' => 'required',
                'No_Pages' => 'required',
                'No_Stock' => 'required',
            ]);

            $Title = $request->input('Title');
            $Author = $request->input('Author');
            $Copyright = $request->input('Copyright');
            $No_Pages = (int)$request->input('No_Pages');
            $No_Stock = (int)$request->input('No_Stock');

            $data=array(
                'Title'=>$Title,
                "Author"=>$Author,
                "Copyright"=>$Copyright,
                "No_pages"=>$No_Pages,
                "Stock"=>$No_Stock,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now());

            DB::table('books')->insert($data);
            
            $books = DB::table('books')->select('*')->get();
    
            return view('books',['message' => 'Successfully Created','name' => $name,'books' => $books]);
            }
            else {
                return view('login',['message' => 'Error!']);
            } 

        } catch (\Exception $e) {
            $name = session('uniname');
            $books = DB::table('books')->select('*')->get();
            return view('books',['message' => 'Error Occured! Please Try Again Later...','name' => $name,'books' => $books]);
        }
    }

    public function edit(Request $request) {
        try {

    $name = session('uniname');

    if(!$name == null){
        $this->validate($request, [
            'Title' => 'required',
            'Author' => 'required',
            'Copyright' => 'required',
            'No_Pages' => 'required',
            'No_Stock' => 'required',
        ]);

        $Book_id = $request->input('Book_id');
        $Title = $request->input('Title');
        $Author = $request->input('Author');
        $Copyright = $request->input('Copyright');
        $No_Pages = $request->input('No_Pages');
        $No_Stock = $request->input('No_Stock');

        DB::table('books')->where('Book_id', $Book_id)->update(['Title' => $Title ,'Author' => $Author,'Copyright' => $Copyright,'No_pages' => $No_Pages,'Stock' => $No_Stock,'updated_at' => \Carbon\Carbon::now()]);
        $books = DB::table('books')->select('*')->get();

        return view('books',['message' => 'Successfully Edited','name' => $name,'books' => $books]);
    }
    else {
        return view('login',['message' => 'Error!']);
    } 
    
} catch (\Exception $e) {
    $name = session('uniname');
    $books = DB::table('books')->select('*')->get();
    return view('books',['message' => 'Error Occured! Please Try Again Later...','name' => $name,'books' => $books]);
}

    }

    public function delete($Book_id) {
        try {
        $name = session('uniname');

    if(!$name == null){
        DB::table('transactions')->where('Book_id', $Book_id)->delete();
        DB::table('historys')->where('Book_id', $Book_id)->delete();
        DB::table('books')->where('Book_id', $Book_id)->delete();
        $name = session('uniname');
        $books = DB::table('books')->select('*')->get();
        return view('books',['message' => 'Successfully Deleted.','name' => $name,'books' => $books]);
    }
    else {
        return view('login',['message' => 'Error!']);
    } 

} catch (\Exception $e) {
    $name = session('uniname');
    $books = DB::table('books')->select('*')->get();
    return view('books',['message' => 'Error Occured! Please Try Again Later...','name' => $name,'books' => $books]);
}

    }

    public function createdisplay() {

        $name = session('uniname');
    if(!$name == null){
        return view('book.create',['name' => $name]);
    }
    else {
        return view('login',['message' => 'Error!']);
    } 
    }

    public function editdisplay($Book_id) {

        $name = session('uniname');

        if(!$name == null){

            $Title = DB::table('books')->select('Title')->where('Book_id', $Book_id)->pluck('Title')->first();
            $Author = DB::table('books')->select('Author')->where('Book_id', $Book_id)->pluck('Author')->first();
            $Copyright = DB::table('books')->select('Copyright')->where('Book_id', $Book_id)->pluck('Copyright')->first();
            $No_pages = DB::table('books')->select('No_pages')->where('Book_id', $Book_id)->pluck('No_pages')->first();
            $Stock = DB::table('books')->select('Stock')->where('Book_id', $Book_id)->pluck('Stock')->first();
                
            return view('book.edit', ['name' => $name,'Book_id' => $Book_id,'Title' => $Title,'Author' => $Author,'Copyright' => $Copyright,'No_pages' => $No_pages,'Stock' => $Stock]);
            
        }

        else {
            return view('login',['message' => 'Error!']);
        } 

   }

}
