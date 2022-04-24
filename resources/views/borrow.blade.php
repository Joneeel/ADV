<!DOCTYPE html>
<html lang="en">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="shortcut icon" href="{{ asset('Image/libraryicon.ico') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISSUE BOOK BORROW (LMS) </title>
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
<center>
<body style='background-color: #88dad5'>  
  <div style="display: inline-flex;">
    <h1 data-aos="fade-right" data-aos-duration="500" class="mainname"> ISSUE BOOK BORROW </h1>
      <a data-aos="fade-left" data-aos-duration="500" href="{{ route('issuedisplay') }}" class="issuenewbook"> ISSUE NEW BOOK </a>
      @if(!empty(session()->get('message')))
      <h2 class='logged2'> Message: <br> {{ session()->get('message') }} </h2> 
      @endif
    </form>
  </div>
  <form action="{{ route('searchissue') }}" method="any">
    @csrf 
      <div data-aos="fade-left" data-aos-duration="500" class="searcholder">
        <label class='search'> Search: </label>
        <input class="inputs" type="text" name="searchissue" class="form-control" value="" placeholder="Search for the name of borrower.." required>
        <input class="button" style="margin-top: 20px;" type="submit" name="login" class="btn btn-danger" value="Search"/>
       </div>
  </form>
  @if(!empty($issuebookborrow) && $issuebookborrow->count())
<table>
  <tr>
    <th>Transac_id</th>
    <th>Book_id</th>
    <th>Borrower_id</th>
    <th>DateBorrowed</th>
    <th>DueDateReturned</th>
    <th>Fullname</th>
    <th>BookTitle</th>
    <th>Created_at</th>
    <th>Updated_at</th>
    <th>Returned</th>
  </tr>
  @foreach($issuebookborrow as $key => $data)
  <tr class="tablerow">
    <td>{{ $data->Transac_id }}</td>
    <td>{{ $data->Book_id }}</td>
    <td>{{ $data->Borrower_id }}</td>
    <td>{{ $data->DateBorrowed }}</td>
    <td>{{ $data->DueDateReturned }}</td>
    <td>{{ $data->Fullname }}</td>
    <td>{{ $data->BookTitle }}</td>
    <td>{{ $data->created_at }}</td>
    <td>{{ $data->updated_at }}</td>
    <td class="deletebutton">
      <form action="{{ route('returned', $data->Transac_id) }}" method="any" class="form-hidden">
        <button >Returned</button>
        @csrf
      </form>
    </td>
  </tr>
  @endforeach
  @else   
        <div style="margin-top: 150px; font-family: Arial; font-weight: bold;">
                <tr>
                    <td classcolspan="10">There are no data.</td>
                </tr>
        </div>
  @endif
</table>
{{ $issuebookborrow->links('vendor\pagination\default') }}
<footer>
  <p>Author: Montera, Bula, Gonzales<br>
  <a href="https://henly09.github.io/MyPortfolio/" target="_blank">MonteraBulaGonzales™ 2022</a></p>
</footer>  
</body>
</center>
</html>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<style>  

.tablerow:hover {
  background-color: #B0BFAB;
  transition: 0.3s;
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

.logged2{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  position: absolute;
  font-size: 16px;
  right: 75%;
  top: 200px;
  padding: 5px;
  border-radius: 5px;
  background-color: #f4645c;
  
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

.issuenewbook{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  position: absolute;
  margin-left: 45%;
  background-color: green; 
  border: none;
  color: white;
  padding: 12px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  transition: 0.3s;
  border-radius: 5px;
  font-family: 'Arial';
  font-weight: bold;
  margin-top:28px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
}

.issuenewbook:hover{
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


.mainname{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  font-size: 40px;
  text-shadow: 2px 2px #f9eebd;
  box-shadow: 0px 4px 2px -2px rgba(0,0,0,0.5);
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

</style>

