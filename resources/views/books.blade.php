<!DOCTYPE html>
<html lang="en">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="shortcut icon" href="{{ asset('Image/libraryicon.ico') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKS (LMS) </title>
</head>
<center>
<nav class="navbar navbar-inverse">

    <div data-aos="fade-down" data-aos-duration="500" class="header">
     <img class="logo" src="{{ asset('Image/logo.png') }}"/>   
      <a style="margin-right: 200px; text-decoration: none;text-shadow: 2px 2px gray;" class="navbar-brand" href="{{ route('dashboard')}}">LIBRARY MANAGEMENT SYSTEM</a>
      <div class="dropdown">
      <button class="dropbtn">👤 Account Logged: {{ $name }}</button>
      <div class="dropdown-content">
      <a href="{{ route('displaychangepass') }}">Change Password</a>
      </div>
      </div>
    </div>

    <ul data-aos="fade-down" data-aos-duration="500" class="nav navbar-nav">
      <a class='navi' href="{{ route('dashboard')}}">DASHBOARD</a>
      <a class='navi' href="{{ route('books')}}">BOOKS</a>
      <a class='navi' href="{{ route('borrower')}}">BORROWERS</a>
      <a class='navi' href="{{ route('notreturnedbooks')}}">NOT RETURNED BOOKS</a>
      <a class='navi' href="{{ route('borrow')}}">ISSUE BOOK BORROW</a>
      <a class='navi' href="{{ route('transactionhistory')}}">TRANSACTION HISTORY</a>
      <a class='navilogout' href="{{ route('logout')}}">LOGOUT</a>
    </ul>
</nav>
</center>

<div class="tab">
  <button data-aos="fade-down" data-aos-duration="500" class="tablinks" onclick="openTab(event, 'Active')">AVAILABLE</button>
  <button data-aos="fade-down" data-aos-duration="500" class="tablinks" onclick="openTab(event, 'NotActive')">ARCHIVED</button>
</div>

<!-- Not Archived -->
<div id="Active" class="tabcontent">
  <body  style='background-color: #88dad5'> 
  <center>
  <div style="display: inline-flex;">
    <h1 data-aos="fade-down" data-aos-duration="500" class="mainname"> AVAILABLE BOOKS </h1>
      <a data-aos="fade-down" data-aos-duration="500" href="{{ route('bookcreate') }}" class="addnewbook"> CREATE NEW BOOK </a>
      @if(!empty(session()->get('message')))
      <h2 class='logged2'> Message: <br> {{ session()->get('message') }} </h2> 
      @endif
    </form>
  </div>

  <form action="{{ route('searchbook') }}" method="any">
    @csrf 
      <div class="searcholder">
        <label class='search'> Search Title: </label>
        <input class="inputs" type="text" name="searchtitle" value="" placeholder="Search for the Title of the Book.." required>
        <input class="button" style="margin-top: 20px;" type="submit" name="login" class="btn btn-danger" value="Search"/>
       </div>
  </form>
  <form action="{{ route('searchbookcategory') }}" method="any">
    @csrf 
      <div class="searcholder">
        <label class='search'> Search Category: </label>
        <select id="typeid" class="inputs2" name="type" required>
            <option value=""> Select Type... </option>
            <option value="Fiction">Fiction</option>
            <option value='NonFiction'>Non Fiction</option>
        </select>
        <select id="categoryid" class="inputs2" name="category" required>
        </select>
        <input class="button" style="margin-top: 20px;" type="submit" name="login" class="btn btn-danger" value="Search"/>
       </div>
  </form>

  @if(!empty($books) && $books->count())
<table class="table-sortable">
<thead>
  <tr>
    <th><a class="sorter" href="{{ route('bookidsort') }}"> Book_id </a></th>
    <th><a class="sorter" href="{{ route('titlesort') }}"> Title </a></th>
    <th><a class="sorter" href="{{ route('authorsort') }}"> Author </a></th>
    <th><a class="sorter" href="{{ route('copyrightsort') }}"> Copyright </a></th>
    <th><a class="sorter" href="{{ route('typesort') }}"> Type </a></th>
    <th><a class="sorter" href="{{ route('categorysort') }}"> Category </a></th>
    <th><a class="sorter" href="{{ route('nopagesort') }}"> No_pages </a></th>
    <th><a class="sorter" href="{{ route('nostocksort') }}"> No_Stock </a></th>
    <th>Status</th>
    <th>Edit</th>
    <th>Delete</th>
    <th>View</th>
  </tr>
  </thead>
  @foreach($books as $key => $data)
  <tbody>
  <tr class="tablerow">
    <td>{{ $data->Book_id }}</td>
    <td>{{ $data->Title }}</td>
    <td>{{ $data->Author }}</td>
    <td>{{ $data->Copyright }}</td>
    <td>{{ $data->Type }}</td>
    <td>{{ $data->Category }}</td>
    <td>{{ $data->No_pages }}</td>
    <td>{{ $data->Stock }}</td>
    <td>{{ $data->status }}</td>
    <td class="editbutton">
      <form action="{{ route('bookedit',$data->Book_id)}}" method="any" class="form-hidden">
        <button>Edit ✏️</button>
        @csrf
      </form>
    </td>
    <td class="deletebutton">
      <form action="{{ route('bookdelete', $data->Book_id) }}" method="any" class="form-hidden">
        <button>Delete ❌</button>
        @csrf
      </form>
    </td>
    <td class="viewbutton">
      <form action="{{ route('bookview',$data->Book_id)}}" method="any" class="form-hidden">
        <button>View 📖</button>
        @csrf
      </form>
    </td>
  </tr>
  </tbody>
  @endforeach
  @else
  <div style="margin-top: 180px; font-family: Arial; font-weight: bold;">
                <tr>
                    <td classcolspan="10">There are no data.</td>
                </tr>
        </div>
  @endif
</table>
{{ $books->links('vendor\pagination\default') }}
</body>
</center>
<footer>
  <p>Author: Montera, Bula, Gonzales<br>
  <a href="https://henly09.github.io/MyPortfolio/" target="_blank">MonteraBulaGonzales™ 2022</a></p>
</footer>
</div>

<!-- Archived -->

<div id="NotActive" class="tabcontent">
<center>
  <body  style='background-color: #88dad5'> 
  <div style="display: inline-flex;">
    <h1 class="mainname"> ARCHIVED BOOKS </h1>
      @if(!empty(session()->get('message2')))
      <h2 class='logged2'> Message: <br> {{ session()->get('message2') }} </h2> 
      @endif
    </form>
  </div>
  <form action="{{ route('searcharchivebook') }}" method="any">
    @csrf 
      <div class="searcholder">
        <label class='search'> Search: </label>
        <input class="inputs" type="text" name="searcharchivetitle" value="" placeholder="Search for the Title of the Book.." required>
        <input class="button" style="margin-top: 20px;" type="submit" name="login" class="btn btn-danger" value="Search"/>
       </div>
  </form>
  @if(!empty($archivebooks) && $archivebooks->count())
<table>
  <tr>
    <th>Book id</th>
    <th>Title</th>
    <th>Author</th>
    <th>Copyright</th>
    <th>Type</th>
    <th>Category</th>
    <th>No_pages</th>
    <th>No_Stock</th>
    <th>Created_at</th>
    <th>Archived_at</th>
    <th>Status</th>
  </tr>
  @foreach($archivebooks as $key => $data2)
  <tr class="tablerow">
    <td>{{ $data2->Book_id }}</td>
    <td>{{ $data2->Title }}</td>
    <td>{{ $data2->Author }}</td>
    <td>{{ $data2->Copyright }}</td>
    <td>{{ $data2->Type }}</td>
    <td>{{ $data2->Category }}</td>
    <td>{{ $data2->No_pages }}</td>
    <td>{{ $data2->Stock }}</td>
    <td>{{ $data2->created_at }}</td>
    <td>{{ $data2->updated_at }}</td>
    <td>{{ $data2->status }}</td>
  </tr>
  @endforeach
  @else   
        <div style="margin-top: 180px; font-family: Arial; font-weight: bold;">
                <tr>
                    <td classcolspan="10">There are no data.</td>
                </tr>
        </div>
  @endif
</table>
<footer>
  <p>Author: Montera, Bula, Gonzales<br>
  <a href="https://henly09.github.io/MyPortfolio/" target="_blank">MonteraBulaGonzales™ 2022</a></p>
</footer>
</body>
</center>
</div>

</html>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

 $(document).ready(function() {

$("#typeid").change(function() {
  var val = $(this).val();
  if (val == "Fiction") {
    $("#categoryid").html("<option value='Action and adventure'>Action and adventure</option>"
      	 		    +"<option value='Alternate history'>Alternate history</option>"
                +"<option value='Anthology'>Anthology</option>"
      	 		    +"<option value='Chick lit'>Chick lit</option>"
                +"<option value='Children's'>Children's</option>"
      	 		    +"<option value='Classic'>Classic</option>"
                +"<option value='Comic book'>Comic book</option>"
      	 		    +"<option value='Coming-of-age'>Coming-of-age</option>"
                +"<option value='Crime'>Crime</option>"
      	 		    +"<option value='Drama'>Drama</option>"
                +"<option value='Fairytale'>Fairytale</option>"
      	 		    +"<option value='Fantasy'>Fantasy</option>"
                +"<option value='Graphic novel'>Graphic novel</option>"
      	 		    +"<option value='Historical fiction'>Historical fiction</option>"
                +"<option value='Horror'>Horror</option>"
      	 		    +"<option value='Mystery'>Mystery</option>"
                +"<option value='Paranormal romance'>Paranormal romance</option>"
      	 		    +"<option value='Picture book'>Picture book</option>"
                +"<option value='Poetry'>Poetry</option>"
      	 		    +"<option value='Political thriller'>Political thriller</option>"
                +"<option value='Romance'>Romance</option>"
      	 		    +"<option value='Satire'>Satire</option>"
                +"<option value='Science fiction'>Science fiction</option>"
      	 		    +"<option value='Short story'>Short story</option>"
                +"<option value='Suspense'>Suspense</option>"
      	 		    +"<option value='Thriller'>Thriller</option>"
                +"<option value='Western'>Western</option>"
      	 		    +"<option value='Young adult'>Young adult</option>");

  } else if (val == "NonFiction") {
    $("#categoryid").html("<option value='Art/architecture'>Art/architecture</option>"
      	 		    +"<option value='Autobiography'>Autobiography</option>"
                +"<option value='Biography'>Biography</option>"
      	 		    +"<option value='Business/economics'>Business/economics</option>"
                +"<option value='Crafts/hobbies'>Crafts/hobbies</option>"
      	 		    +"<option value='Cookbook'>Cookbook</option>"
                +"<option value='Diary'>Diary</option>"
      	 		    +"<option value='Dictionary'>Dictionary</option>"
                +"<option value='Encyclopedia'>Encyclopedia</option>"
      	 		    +"<option value='Guide'>Guide</option>"
                +"<option value='Health/fitness'>Health/fitness</option>"
      	 		    +"<option value='History'>History</option>"
                +"<option value='Home and garden'>Home and garden</option>"
      	 		    +"<option value='Humor'>Humor</option>"
                +"<option value='Journal'>Journal</option>"
      	 		    +"<option value='Math'>Math</option>"
                +"<option value='Memoir'>Memoir</option>"
      	 		    +"<option value='Philosophy'>Philosophy</option>"
                +"<option value='Prayer'>Prayer</option>"
      	 		    +"<option value='Religion, spirituality, and new age'>Religion, spirituality, and new age</option>"
                +"<option value='Textbook'>Textbook</option>"
      	 		    +"<option value='True crime'>True crime</option>"
                +"<option value='Review'>Review</option>"
      	 		    +"<option value='Science'>Science</option>"
                +"<option value='Self help'>Self help</option>"
      	 		    +"<option value='Sports and leisure'>Sports and leisure</option>"
                +"<option value='Travel'>Travel</option>"
      	 		    +"<option value='True crime'>True crime</option>");
  } else {
    $("#categoryid").html("<option value=''>Select Category..</option>");
  }
});
});
</script>

<script>

  document.getElementsByClassName('tablinks')[{{ $page }}].click();

  function openTab(evt, tab) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tab).style.display = "block";
  evt.currentTarget.className += " active";
}

</script>

<style>

.tablerow:hover {
  background-color: #C7E3AF;
  transition: 0.3s;
}

/* Go from zero to full opacity */
@keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}

/* Style the tab */
.tab {
  margin-top:20px;
  overflow: hidden;
  background-color: #D9F5D1;
  width: 300px;
  padding-left: 30px;
  border-radius: 5px 5px 0px 0px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: #D9F5D1;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  margin: 8px;
  transition: 0.3s;
  margin-left: 25px;
  font-family: 'Arial';
  font-weight: bold;
  padding:10px;
  color: black;
  font-size:14px;
  border-radius: 3px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #A5C19E;
  color: white;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #7A8D75;
  color: white;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border-radius: 0px 5px 5px 5px;
  background-color: #D9F5D1;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);


}
   /* Style The Dropdown Button */
.dropbtn {
   background-color: #efb79d;
   padding: 10px;
   margin-top: -5px;
   border-radius: 5px 5px 0px 0px;
   font-family: 'Arial';
   font-weight: bold;
   color: black;
   font-size: 15px;
   transition: 0.3s;
   box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
  transition: 0.3s;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #efb79d;
  min-width: 205px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  font-family: 'Arial';
   font-weight: bold;
   color: black;
   font-size: 15px;
   border-radius: 0px 0px 5px 5px;
   transition: 0.3s;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  transition: 0.3s;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
  background-color: red;
  border-radius: 0px 0px 5px 5px;
  color:white;
  transition: 0.3s;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
  transition: 0.3s;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: #cf7c5c;
  transition: 0.3s;
  color:white;
}

.logo{
  height: 80px;
  width: 80px;
  margin-right: 15px;
  margin-top: -20px;
} 

.searcholder{
  margin-top: -30px;
  margin-bottom: 20px;
}

.search {
  font-family: 'Arial';
  font-weight: bold;
  color: black;
}

.button {
  background-color: #4CAF50; 
  border: none;
  color: white;
  padding: 8px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  transition: 0.3s;
  border-radius: 5px;
  font-family: 'Arial';
  font-weight: bold;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
}

.button:hover {
  background-color: white; 
  border: none;
  color: #4CAF50;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  transition: 0.3s;
}

.inputs {
  width: 20%;
  padding: 5px 10px;
  margin: 8px 0;
  box-sizing: border-box;
  border-radius: 5px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
}

.inputs2 {
  width: 15%;
  padding: 5px 10px;
  margin: 8px 0;
  box-sizing: border-box;
  border-radius: 5px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
}

footer{
  margin-top:15%;
  background-color: #ceb396;
  padding: 15px 0px 15px 0px;
  border-radius: 5px;
  text-align:center;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
}

footer > p{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  padding-bottom:5px;
}

footer > a{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  padding-top:5px;
}

.logged2{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  position: absolute;
  font-size: 16px;
  right: 70%;
  top: 270px;
  padding: 5px;
  border-radius: 5px;
  background-color: #f4645c;
}

.addnewbook{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  position: absolute;
  margin-left: 42%;
  background-color: green; 
  border: none;
  color: white;
  padding: 12px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 5px;
  transition: 0.3s;
  margin-top:85px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
}

.addnewbook:hover{
  background-color: white; 
  color: green;
  transition: 0.3s;
}

.deletebutton > form > button {
  background-color: red; 
  border: none;
  color: white;
  padding: 12px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  transition: 0.3s;
  border-radius: 5px;
  font-family: 'Arial';
  font-weight: bold;
  margin-top:3px;
}

.deletebutton > form > button:hover {
  background-color: white; 
  color: red;
}

.editbutton > form > button {
  background-color: green; 
  border: none;
  color: white;
  padding: 12px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  transition: 0.3s;
  border-radius: 5px;
  font-family: 'Arial';
  font-weight: bold;
  margin-top:3px;
}

.editbutton > form > button:hover {
  background-color: white; 
  color: green;
}

.viewbutton > form > button {
  background-color: gray; 
  border: none;
  color: white;
  padding: 12px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  transition: 0.3s;
  border-radius: 5px;
  font-family: 'Arial';
  font-weight: bold;
  margin-top:3px;
}

.viewbutton > form > button:hover {
  background-color: white; 
  color: gray;
}

.mainname{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  font-size: 40px;
  text-shadow: 2px 2px #f9eebd;
  box-shadow: 0px 4px 2px -2px rgba(0,0,0,0.5);
}

table{
  margin-top: 50px;
  margin-bottom: 50px;
  font-family: Verdana, Sans-Serif;
  border-collapse: collapse;
  width: 100%;
  color: #373836;
}

th{
  background-color: #C7E3AF;
}

td,th{
  border: 1px solid #373836;
  text-align: left;
  padding: 5px;
  font-size: 13px;
  text-align:center;
}

.sorter{
  text-decoration: none;
  font-size:15px;
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  transition: 0.3s;
}

.sorter:hover{
  color:white;
  transition: 0.3s;
}


.header{
  display: flex; 
  justify-content: center; 
  padding-top: 30px;
}

.navi{
  padding:10px;
  font-size:18px;
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  transition: 0.3s;
  border-radius:5px;
  text-decoration: none;
}

.navi:hover{
  padding:10px;
  font-size:18px;
  font-family: 'Arial';
  font-weight: bold;
  color: white;
  background-color:#343434;
  transition: 0.3s;
}

.navilogout{
  padding:10px;
  font-size:18px;
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  transition: 0.3s;
  border-radius:5px;
  text-decoration: none;
}

.navilogout:hover{
  padding:10px;
  font-size:18px;
  font-family: 'Arial';
  font-weight: bold;
  color: white;
  background-color:red;
  transition: 0.3s;
}

ul.nav{
  background-color: #edd8c0;
  padding: 18px;
  border-radius: 5px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
  margin-top: 25px;
}

a.navbar-brand{
  font-size:35px;
  font-family: 'Arial';
  font-weight: bold;
  color: black;
}

div.navbar-header{
  flex-direction: row;
}

.logged{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
}
</style>

