<!DOCTYPE html>
<html lang="en">

<link rel="shortcut icon" href="{{ asset('Image/libraryicon.ico') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKS (LMS) </title>
</head>
<center>
<nav class="navbar navbar-inverse">

    <div class="header">
     <img class="logo" src="{{ asset('Image/logo.png') }}"/>   
      <a style="margin-right: 25%; text-decoration: none;" class="navbar-brand" href="{{ route('dashboard')}}">LIBRARY MANAGEMENT SYSTEM</a>
      <div class="dropdown">
      <button class="dropbtn">Account Logged: {{ $name }}</button>
      <div class="dropdown-content">
      <a href="{{ route('displaychangepass') }}">Change Password</a>
      </div>
      </div>
    </div>

    <ul class="nav navbar-nav">
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
  <button class="tablinks" onclick="openTab(event, 'Active')">AVAILABLE</button>
  <button class="tablinks" onclick="openTab(event, 'NotActive')">ARCHIVED</button>
</div>

<!-- Not Archived -->
<div id="Active" class="tabcontent">
  <body data-aos="fade-down" data-aos-delay="300" style='background-color: #56f0ba'> 
  <center>
  <div style="display: inline-flex;">
    <h1 class="mainname"> AVAILABLE BOOKS </h1>
      <a href="{{ route('bookcreate') }}" class="addnewbook"> CREATE NEW BOOK </a>
      @if(!empty(session()->get('message')))
      <h2 class='logged2'> Message: <br> {{ session()->get('message') }} </h2> 
      @endif
    </form>
  </div>
  <form action="{{ route('searchbook') }}" method="any">
    @csrf 
      <div class="searcholder">
        <label class='search'> Search: </label>
        <input class="inputs" type="text" name="searchtitle" class="form-control" value="" placeholder="Search for the Title of the Book.." required>
        <input class="button" style="margin-top: 20px;" type="submit" name="login" class="btn btn-danger" value="Search"/>
       </div>
  </form>
  @if(!empty($books) && $books->count())
<table>
  <tr>
    <th>Book_id</th>
    <th>Title</th>
    <th>Author</th>
    <th>Copyright</th>
    <th>Type</th>
    <th>Category</th>
    <th>No_pages</th>
    <th>No_Stock</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
  @foreach($books as $key => $data)
  <tr>
    <td>{{ $data->Book_id }}</td>
    <td>{{ $data->Title }}</td>
    <td>{{ $data->Author }}</td>
    <td>{{ $data->Copyright }}</td>
    <td>{{ $data->Type }}</td>
    <td>{{ $data->Category }}</td>
    <td>{{ $data->No_pages }}</td>
    <td>{{ $data->Stock }}</td>
    <td class="editbutton">
      <form action="{{ route('bookedit',$data->Book_id)}}" method="any" class="form-hidden">
        <button>Edit</button>
        @csrf
      </form>
    </td>
    <td class="deletebutton">
      <form action="{{ route('bookdelete', $data->Book_id) }}" method="any" class="form-hidden">
        <button >Delete</button>
        @csrf
      </form>
    </td>
  </tr>
  @endforeach
  @else
                <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
  @endif
</table>
{{ $books->links('vendor\pagination\default') }}
</body>
</center>
<footer>
  <p>Author: John Henly A. Montera<br>
  <a href="https://henly09.github.io/MyPortfolio/" target="_blank">Montera™ 2022</a></p>
</footer>
</div>

<!-- Archived -->

<div id="NotActive" class="tabcontent">
<center>
  <body data-aos="fade-down" data-aos-delay="300" style='background-color: #56f0ba'> 
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
        <input class="inputs" type="text" name="searcharchivetitle" class="form-control" value="" placeholder="Search for the Title of the Book.." required>
        <input class="button" style="margin-top: 20px;" type="submit" name="login" class="btn btn-danger" value="Search"/>
       </div>
  </form>
<table>
  <tr>
    <th>Archived Book id</th>
    <th>Title</th>
    <th>Author</th>
    <th>Copyright</th>
    <th>Type</th>
    <th>Category</th>
    <th>No_pages</th>
    <th>No_Stock</th>
  </tr>
  @foreach($archivebooks as $key => $data2)
  <tr>
    <td>{{ $data2->archive_book_id }}</td>
    <td>{{ $data2->Title }}</td>
    <td>{{ $data2->Author }}</td>
    <td>{{ $data2->Copyright }}</td>
    <td>{{ $data2->Type }}</td>
    <td>{{ $data2->Category }}</td>
    <td>{{ $data2->No_pages }}</td>
    <td>{{ $data2->Stock }}</td>
  </tr>
  @endforeach
</table>
<footer>
  <p>Author: John Henly A. Montera<br>
  <a href="https://henly09.github.io/MyPortfolio/" target="_blank">Montera™ 2022</a></p>
</footer>
</body>
</center>
</div>

</html>

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

.tabcontent {
  animation: fadeEffect 1s; /* Fading effect takes 1 second */
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
  border: 1px solid #ccc;
  background-color: #70f72d;
  border: 2px solid black;
  width: 300px;
  padding-left: 30px;
  border-radius: 10px 10px 0px 0px;
  border-bottom: none;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: #70f72d;
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
  background-color: #3e8e41;
  color: white;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #3e8e41;
  color: white;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border-radius: 0px 10px 10px 10px;
  border: 2px solid black;
  background-color: #70f72d;

}
/* Style The Dropdown Button */
.dropbtn {
   background-color: #70f72d;
   padding: 10px;
   margin-top: -7px;
   border-radius: 10px 10px 0px 0px;
   border: 2px solid black;
   font-family: 'Arial';
   font-weight: bold;
   color: black;
   font-size: 20px;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #70f72d;
  min-width: 235px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  font-family: 'Arial';
   font-weight: bold;
   color: black;
   font-size: 16px;
   border-radius: 0px 0px 10px 10px;
   border: 2px solid black;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
  background-color: red;
  border-radius: 0px 0px 10px 10px;
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
  background-color: #3e8e41;
  transition: 0.3s;
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
  border-radius: 10px;
  font-family: 'Arial';
  font-weight: bold;
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
}

footer{
  margin-top:15%;
  background-color: #348c4c;
  padding: 15px 0px 15px 0px;
  border-radius: 5px;
  text-align:center;
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
  right: 72%;
  top: 270px;
  padding: 5px;
  border-radius: 10px;
  border: 2px solid black;
  background-color: #70f72d;
}

.addnewbook{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  position: absolute;
  margin-left: 35%;
  background-color: green; 
  border: none;
  color: white;
  padding: 12px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  transition: 0.3s;
  border-radius: 10px;
  margin-top:80px;
}

.addnewbook:hover{
  background-color: white; 
  color: green;
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
  border-radius: 10px;
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
  border-radius: 10px;
  font-family: 'Arial';
  font-weight: bold;
  margin-top:3px;
}

.editbutton > form > button:hover {
  background-color: white; 
  color: green;
}

.mainname{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  font-size: 40px;
}

  table, th, td {
  border: 1px solid black;
  text-align:center;
  padding:5px;
  font-size:15px;
  font-family: 'Arial';
  font-weight: bold;
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
  background-color:black;
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
  background-color: #70f72d;
  padding: 15px;
  border-radius: 10px;
  border: 2px solid black;
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

