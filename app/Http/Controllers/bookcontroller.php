<?php

namespace App\Http\Controllers;
use App\Models\book;
use Illuminate\Http\Request;
use DB;

class bookcontroller extends Controller
{

/**
 * The above function is used to create a new book.
 * 
 * @param Request request This is the request object that contains the data that was submitted to the
 * route.
 * 
 * @return the view of the login page with a message.
 */
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
                "status"=>'Active',
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            );

            DB::table('books')->insert($data);
            
            return redirect()->route('books')->with('message','Successfully Created');
            }
            else {
                return view('login',['message' => 'Error!']);
            } 

        } catch (\Exception $e) {
            return redirect()->route('books')->with('message','Error Occured! Please Try Again Later...');
        }
    }

/**
 * It takes the data from the edit form and updates the database with the new data.
 * 
 * @param Request request The request object.
 * 
 * @return the view of the login page with the message 'Error!'
 */
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

        return redirect()->route('books')->with('message','Successfully Edited');
    }
    else {
        return view('login',['message' => 'Error!']);
    } 
    
} catch (\Exception $e) {
    return redirect()->route('books')->with('message','Error Occured! Please Try Again Later...');
}
}



/**
 * It checks if the book is borrowed or not, if not, it will be archived.
 * 
 * @param Book_id The id of the book to be deleted.
 * 
 * @return the view of the books page.
 */
    public function delete($Book_id) {
        try{
        $name = session('uniname');

    if(!$name == null){

        $ifextransac = DB::table('transactions')->where('Book_id', $Book_id)->get();
        $ifextransaccount = $ifextransac->count();

        if ($ifextransaccount == 0) {

            DB::table('books')->where('Book_id', $Book_id)->update(['status' => 'NotActive','updated_at' => \Carbon\Carbon::now()]);

            return redirect()->route('books')->with('message','Successfully Archived.');
        }
        else{
            return redirect()->route('books')->with('message','Some of this book are currently borrowed!');
        }
    }
    else {
        return view('login',['message' => 'Error!']);
    } 
}  catch (\Exception $e) {
    return redirect()->route('books')->with('message','Error Occured! Please Try Again Later...');
}
    }

/**
 * It returns the view for creating a book.
 * 
 * @return The create book page is being returned.
 */
    public function createdisplay() {
        try {
        $name = session('uniname');
    if(!$name == null){
        return view('book.create',['name' => $name]);
    }
    else {
        return view('login',['message' => 'Error!']);
    } 
} catch (\Exception $e) {
    $name = session('uniname');
    $books = DB::table('books')->select('*')->where('status','=','Active')->paginate(6);
    $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
    return view('books',['message' => 'Error Occured! Please Try Again Later...','name' => $name,'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
    }
}

/**
 * It displays the edit page for the book with the given Book_id.
 * 
 * @param Book_id The id of the book that is being edited.
 * 
 * @return the view of the edit page with the book details.
 */
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
            return view('login',['message' => 'Error!']);
        } 

   }


/**
 * It takes the Book_id as a parameter and returns the book details in a view.
 * 
 * @param Book_id The id of the book
 * 
 * @return The view of the book.
 */
   public function bookview($Book_id) {

    $name = session('uniname');

    if(!$name == null){

        $Title = DB::table('books')->select('Title')->where('Book_id', $Book_id)->pluck('Title')->first();
        $Author = DB::table('books')->select('Author')->where('Book_id', $Book_id)->pluck('Author')->first();
        $Copyright = DB::table('books')->select('Copyright')->where('Book_id', $Book_id)->pluck('Copyright')->first();
        $Type = DB::table('books')->select('Type')->where('Book_id', $Book_id)->pluck('Type')->first();
        $Category = DB::table('books')->select('Category')->where('Book_id', $Book_id)->pluck('Category')->first();
        $No_pages = DB::table('books')->select('No_pages')->where('Book_id', $Book_id)->pluck('No_pages')->first();
        $Stock = DB::table('books')->select('Stock')->where('Book_id', $Book_id)->pluck('Stock')->first();
            
        return view('book.view', ['name' => $name,'Book_id' => $Book_id,'Title' => $Title,'Author' => $Author,'Type' => $Type,'Category' => $Category,'Copyright' => $Copyright,'No_pages' => $No_pages,'Stock' => $Stock]); 
   
    }

    else {
        return view('login',['message' => 'Error!']);
    } 

}

/**
 * It searches for a book in the database and returns the result to the user.
 * 
 * @param Request request The request object.
 * 
 * @return The searchbook function is being returned.
 */
   public function searchbook(Request $request){

    try {

        $this->validate($request, [
            'searchtitle' => 'required',
        ]);

        $searchtitle = $request->input('searchtitle');

        $name = session('uniname');
        $books = DB::table('books')->select('*')->where('Title','like', '%'.$searchtitle.'%')->where('status','=','Active')->paginate(6);
        $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
        if(!$name == null){
            return view('books',['name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return redirect()->route('books')->with('message','Error Occured in Accessing Book Page! Please Try Again Later...');
    }

   }

/**
 * It searches for a book in the archive and displays it.
 * 
 * @param Request request The request object.
 * 
 * @return The searcharchivebook function is returning the books page with the search results.
 */
   public function searcharchivebook(Request $request){
    try {
        $this->validate($request, [
            'searcharchivetitle' => 'required',
        ]);
        $searcharchivetitle = $request->input('searcharchivetitle');
        $name = session('uniname');
        $books = DB::table('books')->select('*')->where('status','=','Active')->paginate(6);
        $archivebooks = DB::table('books')->select('*')->where('Title','like', '%'.$searcharchivetitle.'%')->where('status','=','NotActive')->get();
        if(!$name == null){
            return view('books',['name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 1]);
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return redirect()->route('books')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
    }
   }

/**
 * It searches for books based on the type and category of the book.
 * 
 * @param Request request The request object.
 * 
 * @return the view of the books page with the books that are searched by the user.
 */
   public function searchbookcategory(Request $request){
    try {

        $this->validate($request, [
            'type' => 'required',
            'category' => 'required',
        ]);

        $type = $request->input('type');
        $category = $request->input('category');
        $name = session('uniname');

        $books = $books = DB::table('books')->select('*')->where('Type','=',$type)->where('Category','=',$category)->where('status','=','Active')->paginate(6);
        $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();

        if(!$name == null){
            return view('books',['name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return redirect()->route('books')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
    }
   }

/**
 * It sorts the books by book id in ascending or descending order.
 * 
 * @param Request request The request object.
 * 
 * @return the books page with the books sorted by book id in ascending order.
 */
public function bookidsort(Request $request){
    try{
        $sortstatus1books = session('sortstatus1books');
        error_log($sortstatus1books);
        $name = session('uniname');
        if(!$name == null){
            if($sortstatus1books == 'ASC'){
                $books = DB::table('books')->select('*')->orderBy('Book_id', 'ASC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'DESC';
                $request->session()->put('sortstatus1books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
            if($sortstatus1books == 'DESC' || $sortstatus1books == null ){
                $books = DB::table('books')->select('*')->orderBy('Book_id', 'DESC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'ASC';
                $request->session()->put('sortstatus1books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return redirect()->route('books')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
    }
}

/**
 * It sorts the books by title in ascending or descending order.
 * 
 * @param Request request The request object.
 * 
 * @return the books page with the books sorted by title in ascending order.
 */
public function titlesort(Request $request){
    try{
        $sortstatus2books = session('sortstatus2books');
        error_log($sortstatus2books);
        $name = session('uniname');
        if(!$name == null){
            if($sortstatus2books == 'ASC'){
                $books = DB::table('books')->select('*')->orderBy('Title', 'ASC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'DESC';
                $request->session()->put('sortstatus2books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
            if($sortstatus2books == 'DESC' || $sortstatus2books == null ){
                $books = DB::table('books')->select('*')->orderBy('Title', 'DESC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'ASC';
                $request->session()->put('sortstatus2books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return redirect()->route('books')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
    }
}

/**
 * It sorts the books by author in ascending or descending order depending on the value of the session
 * variable 'sortstatus3books'.
 * 
 * @param Request request The request object.
 * 
 * @return The books are being returned in a descending order of the author.
 */
public function authorsort(Request $request){
    try{
        $sortstatus3books = session('sortstatus3books');
        error_log($sortstatus3books);
        $name = session('uniname');
        if(!$name == null){
            if($sortstatus3books == 'ASC'){
                $books = DB::table('books')->select('*')->orderBy('Author', 'ASC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'DESC';
                $request->session()->put('sortstatus3books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
            if($sortstatus3books == 'DESC' || $sortstatus3books == null ){
                $books = DB::table('books')->select('*')->orderBy('Author', 'DESC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'ASC';
                $request->session()->put('sortstatus3books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return redirect()->route('books')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
    }
}

/**
 * It sorts the books by copyright in ascending or descending order.
 * 
 * @param Request request The request object.
 * 
 * @return This function is used to sort the books by copyright in ascending or descending order.
 */
public function copyrightsort(Request $request){
    try{
        $sortstatus4books = session('sortstatus4books');
        error_log($sortstatus4books);
        $name = session('uniname');
        if(!$name == null){
            if($sortstatus4books == 'ASC'){
                $books = DB::table('books')->select('*')->orderBy('Copyright', 'ASC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'DESC';
                $request->session()->put('sortstatus4books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
            if($sortstatus4books == 'DESC' || $sortstatus4books == null ){
                $books = DB::table('books')->select('*')->orderBy('Copyright', 'DESC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'ASC';
                $request->session()->put('sortstatus4books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return redirect()->route('books')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
    }
}

/**
 * It sorts the books by type in ascending or descending order.
 * 
 * @param Request request The request object.
 * 
 * @return the books page with the books sorted by type in ascending order.
 */
public function typesort(Request $request){
    try{
        $sortstatus5books = session('sortstatus5books');
        error_log($sortstatus5books);
        $name = session('uniname');
        if(!$name == null){
            if($sortstatus5books == 'ASC'){
                $books = DB::table('books')->select('*')->orderBy('Type', 'ASC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'DESC';
                $request->session()->put('sortstatus5books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
            if($sortstatus5books == 'DESC' || $sortstatus5books == null ){
                $books = DB::table('books')->select('*')->orderBy('Type', 'DESC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'ASC';
                $request->session()->put('sortstatus5books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return redirect()->route('books')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
    }
}

/**
 * It sorts the books by category in ascending or descending order.
 * 
 * @param Request request The request object.
 * 
 * @return the books page with the books sorted by category in ascending order.
 */
public function categorysort(Request $request){
    try{
        $sortstatus6books = session('sortstatus6books');
        error_log($sortstatus6books);
        $name = session('uniname');
        if(!$name == null){
            if($sortstatus6books == 'ASC'){
                $books = DB::table('books')->select('*')->orderBy('Category', 'ASC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'DESC';
                $request->session()->put('sortstatus6books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
            if($sortstatus6books == 'DESC' || $sortstatus6books == null ){
                $books = DB::table('books')->select('*')->orderBy('Category', 'DESC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'ASC';
                $request->session()->put('sortstatus6books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return redirect()->route('books')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
    }
}

/**
 * It sorts the books by number of pages in ascending or descending order.
 * 
 * @param Request request The request object.
 * 
 * @return the books page with the books sorted by the number of pages in ascending or descending
 * order.
 */
public function nopagesort(Request $request){
    try{
        $sortstatus7books = session('sortstatus7books');
        error_log($sortstatus7books);
        $name = session('uniname');
        if(!$name == null){
            if($sortstatus7books == 'ASC'){
                $books = DB::table('books')->select('*')->orderBy('No_pages', 'ASC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'DESC';
                $request->session()->put('sortstatus7books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
            if($sortstatus7books == 'DESC' || $sortstatus7books == null ){
                $books = DB::table('books')->select('*')->orderBy('No_pages', 'DESC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'ASC';
                $request->session()->put('sortstatus7books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return redirect()->route('books')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
    }
}

/**
 * It sorts the books by stock in ascending or descending order.
 * 
 * @param Request request The request object.
 * 
 * @return the view of the books page with the books sorted by the stock in ascending order.
 */
public function nostocksort(Request $request){
    try{
        $sortstatus8books = session('sortstatus8books');
        error_log($sortstatus8books);
        $name = session('uniname');
        if(!$name == null){
            if($sortstatus8books == 'ASC'){
                $books = DB::table('books')->select('*')->orderBy('Stock', 'ASC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'DESC';
                $request->session()->put('sortstatus8books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
            if($sortstatus8books == 'DESC' || $sortstatus8books == null ){
                $books = DB::table('books')->select('*')->orderBy('Stock', 'DESC')->where('status','=','Active')->paginate(6);
                $archivebooks = DB::table('books')->select('*')->where('status','=','NotActive')->get();
                $value = 'ASC';
                $request->session()->put('sortstatus8books', $value);
                return view('books',['message' => '','name' => $name, 'books' => $books,'archivebooks' => $archivebooks,'page' => 0]);
            }
        }
        else {
            return view('login',['message' => 'Error!']);
        }
    } catch (\Exception $e) {
        return redirect()->route('books')->with('message2','Error Occured in Accessing Book Page! Please Try Again Later...');
    }
}

}




