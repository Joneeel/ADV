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
                'type' => 'required',
                'category' => 'required',
                'No_Pages' => 'required',
                'No_Stock' => 'required',
            ]);

            $Title = $request->input('Title');
            $Author = $request->input('Author');
            $Copyright = $request->input('Copyright');
            $Category = $request->input('category');
            $Type = $request->input('type');
            $No_Pages = (int)$request->input('No_Pages');
            $No_Stock = (int)$request->input('No_Stock');

            $data=array(
                'Title'=>$Title,
                "Author"=>$Author,
                "Copyright"=>$Copyright,
                "Type"=>$Type,
                "Category"=>$Category,
                "No_pages"=>$No_Pages,
                "Stock"=>$No_Stock,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            );

            DB::table('books')->insert($data);
            
            $books = DB::table('books')->select('*')->paginate(6);
            $archivebooks = DB::table('archivebook')->select('*')->get();
    
            return view('books',['message' => 'Successfully Created','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
            else {
                $request->session()->flush();
                return view('login',['message' => 'Error!']);
            } 

        } catch (\Exception $e) {
            $name = session('uniname');
            $books = DB::table('books')->select('*')->paginate(6);
            $archivebooks = DB::table('archivebook')->select('*')->get();
            return view('books',['message' => 'Error Occured! Please Try Again Later...','name' => $name,'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
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
            'type' => 'required',
            'category' => 'required',
            'No_Pages' => 'required',
            'No_Stock' => 'required',
        ]);

        $Book_id = $request->input('Book_id');
        $Title = $request->input('Title');
        $Author = $request->input('Author');
        $Copyright = $request->input('Copyright');
        $Type = $request->input('type');
        $Category = $request->input('category');
        $No_Pages = (int)$request->input('No_Pages');
        $No_Stock = (int)$request->input('No_Stock');

        DB::table('books')->where('Book_id', $Book_id)->update(['Title' => $Title ,'Author' => $Author,'Copyright' => $Copyright,'Type' => $Type,'Category' => $Category,'No_pages' => $No_Pages,'Stock' => $No_Stock,'updated_at' => \Carbon\Carbon::now()]);
        $books = DB::table('books')->select('*')->paginate(6);
        $archivebooks = DB::table('archivebook')->select('*')->get();

        return view('books',['message' => 'Successfully Edited','name' => $name,'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
    }
    else {
        $request->session()->flush();
        return view('login',['message' => 'Error!']);
    } 
    
} catch (\Exception $e) {
    $name = session('uniname');
    $books = DB::table('books')->select('*')->paginate(6);
    $archivebooks = DB::table('archivebook')->select('*')->get();
    return view('books',['message' => 'Error Occured! Please Try Again Later...','name' => $name,'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
}

    }



    public function delete($Book_id) {
        try{
        $name = session('uniname');

    if(!$name == null){

        $ifextransac = DB::table('transactions')->where('Book_id', $Book_id)->get();
        $ifextransaccount = $ifextransac->count();

        if ($ifextransaccount == 0) {

           $Title = DB::table('books')->select('Title')->where('Book_id', $Book_id)->pluck('Title')->first();
           $Author = DB::table('books')->select('Author')->where('Book_id', $Book_id)->pluck('Author')->first();
           $Copyright = DB::table('books')->select('Copyright')->where('Book_id', $Book_id)->pluck('Copyright')->first();
           $Type = DB::table('books')->select('Type')->where('Book_id', $Book_id)->pluck('Type')->first();
           $Category = DB::table('books')->select('Category')->where('Book_id', $Book_id)->pluck('Category')->first();
           $No_pages = DB::table('books')->select('No_pages')->where('Book_id', $Book_id)->value('No_pages');
           $Stock = DB::table('books')->select('Stock')->where('Book_id', $Book_id)->value('Stock');

            $data=array(
                "Title" => $Title,
                "Author" => $Author,
                "Copyright" => $Copyright,
                "Type" => $Type,
                "Category" => $Category,
                "No_pages" => $No_pages,
                "Stock" => $Stock,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            );

            DB::table('archivebook')->insert($data);
            
            DB::table('books')->where('Book_id', $Book_id)->delete();

            $name = session('uniname');
            $books = DB::table('books')->select('*')->paginate(6);
            $archivebooks = DB::table('archivebook')->select('*')->get();
            return view('books',['message' => 'Successfully Archived.','name' => $name,'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
        }
        else{
            $name = session('uniname');
            $books = DB::table('books')->select('*')->paginate(6);
            $archivebooks = DB::table('archivebook')->select('*')->get();
            return view('books',['message' => 'Some of this book are currently borrowed!','name' => $name,'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
        }
    }
    else {
        $request->session()->flush();
        return view('login',['message' => 'Error!']);
    } 
}  catch (\Exception $e) {
    $name = session('uniname');
    $books = DB::table('books')->select('*')->paginate(6);
    $archivebooks = DB::table('archivebook')->select('*')->get();
    return view('books',['message' => 'Error Occured! Please Try Again Later...','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
}



    }

    public function createdisplay() {
        try {
        $name = session('uniname');
    if(!$name == null){
        return view('book.create',['name' => $name]);
    }
    else {
        $request->session()->flush();
        return view('login',['message' => 'Error!']);
    } 
} catch (\Exception $e) {
    $name = session('uniname');
    $books = DB::table('books')->select('*')->paginate(6);
    $archivebooks = DB::table('archivebook')->select('*')->get();
    return view('books',['message' => 'Error Occured! Please Try Again Later...','name' => $name,'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
    }
}

    public function editdisplay($Book_id) {

        $name = session('uniname');

        if(!$name == null){

            $Title = DB::table('books')->select('Title')->where('Book_id', $Book_id)->pluck('Title')->first();
            $Author = DB::table('books')->select('Author')->where('Book_id', $Book_id)->pluck('Author')->first();
            $Copyright = DB::table('books')->select('Copyright')->where('Book_id', $Book_id)->pluck('Copyright')->first();
            $Type = DB::table('books')->select('Type')->where('Book_id', $Book_id)->pluck('Type')->first();
            $Category = DB::table('books')->select('Category')->where('Book_id', $Book_id)->pluck('Category')->first();
            $No_pages = DB::table('books')->select('No_pages')->where('Book_id', $Book_id)->pluck('No_pages')->first();
            $Stock = DB::table('books')->select('Stock')->where('Book_id', $Book_id)->pluck('Stock')->first();
                
            return view('book.edit', ['name' => $name,'Book_id' => $Book_id,'Title' => $Title,'Author' => $Author,'Type' => $Type,'Category' => $Category,'Copyright' => $Copyright,'No_pages' => $No_pages,'Stock' => $Stock]);
            
        }

        else {
            $request->session()->flush();
            return view('login',['message' => 'Error!']);
        } 

   }

   public function searchbook(Request $request){

    try {

        $this->validate($request, [
            'searchtitle' => 'required',
        ]);

        $searchtitle = $request->input('searchtitle');

        $name = session('uniname');
        $books = DB::table('books')->select('*')->where('Title','like', '%'.$searchtitle.'%')->paginate(6);
        $archivebooks = DB::table('archivebook')->select('*')->get();
        if(!$name == null){
            return view('books',['message' => 'Searched Successfully!','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
        }
        else {
            $request->session()->flush();
            return view('books',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        $name = session('uniname');
        $books = DB::table('books')->select('*')->paginate(6);
        $archivebooks = DB::table('archivebook')->select('*')->get();
        return view('books',['message' => 'Error Occured in Accessing Book Page! Please Try Again Later...','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
    }

   }

   public function searcharchivebook(Request $request){

    try {

        $this->validate($request, [
            'searcharchivetitle' => 'required',
        ]);

        $searcharchivetitle = $request->input('searcharchivetitle');

        $name = session('uniname');
        $books = $books = DB::table('books')->select('*')->paginate(6);
        $archivebooks = DB::table('archivebook')->select('*')->where('Title','like', '%'.$searcharchivetitle.'%')->get();
        if(!$name == null){
            return view('books',['message' => 'Searched Successfully!','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 1]);
        }
        else {
            $request->session()->flush();
            return view('books',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        $name = session('uniname');
        $books = DB::table('books')->select('*')->paginate(5);
        $archivebooks = DB::table('archivebook')->select('*')->get();
        return view('books',['message' => 'Error Occured in Accessing Book Page! Please Try Again Later...','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 1]);
    }

   }

}
