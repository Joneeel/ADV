<!DOCTYPE html>
<html lang="en">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="shortcut icon" href="{{ asset('Image/libraryicon.ico') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD (LMS) </title>
</head>
<center>
<nav class="navbar navbar-inverse">

    <div data-aos="fade-down" data-aos-duration="500" class="header">
      <img class="logo" src="{{ asset('Image/logo.png') }}"/>   
      <a style="margin-right: 200px; text-decoration: none; text-shadow: 2px 2px gray;" class="navbar-brand" href="{{ route('dashboard')}}">LIBRARY MANAGEMENT SYSTEM</a>
      <div class="dropdown">
      <button class="dropbtn">👤 Account Logged: {{ $name }}</button>
      <div class="dropdown-content">
      <a href="{{ route('displaychangepass') }}">Change Password</a>
      </div>
      </div>
    </div>

    <ul data-aos="fade-down" data-aos-duration="500" class="nav navbar-nav">
      <a class='nav' href="{{ route('dashboard')}}">DASHBOARD</a>
      <a class='nav' href="{{ route('books')}}">BOOKS</a>
      <a class='nav' href="{{ route('borrower')}}">BORROWERS</a>
      <a class='nav' href="{{ route('notreturnedbooks')}}">NOT RETURNED BOOKS</a>
      <a class='nav' href="{{ route('borrow')}}">ISSUE BOOK BORROW</a>
      <a class='nav' href="{{ route('transactionhistory')}}">TRANSACTION HISTORY</a>
      <a class='navlogout' href="{{ route('logout')}}">LOGOUT</a>
    </ul>
</nav>
</center>
<body style='background-color: #fd9459' >  
  <center>
    <h1 data-aos="fade-down" data-aos-duration="500" class="mainname"> DASHBOARD </h1>
    @if(!empty(session()->get('message')))
      <h2 class='logged2'> Message: <br> {{ session()->get('message') }} </h2> 
      @endif
      <div data-aos="fade-right" data-aos-duration="500" class="flex-container">
        <div class="card">
        <h1> No. of N.A <br> Borrower Accounts </h1>
        <h1> x{{ $bna }} </h1>
        </div>
        <div class="card">
        <h1> No. of <br> Available Books </h1>
        <h1> x{{ $bookcount }} </h1>
        </div>
        <div class="card">
        <h1> No. of Borrower <br> Active Accounts </h1>
        <h1> x{{ $borrowercount }} </h1>
        </div>
      </div> 
      
      <div data-aos="fade-left" data-aos-duration="500" class="flex-container">
        <div class="card">
        <h1> No. of <br> All Transactions </h1>
        <h1> x{{ $historycount }} </h1>
        </div>
        <div class="card">
        <h1> No. of Books <br> Borrowed </h1>
        <h1> x{{ $transactioncount }} </h1>
        </div>
        <div class="card">
        <h1> No. of Over-Due <br> Returned Books </h1>
        <h1> x{{ $notreturnedcount }} </h1>
        </div>
        <div class="card">
        <h1> No. of <br> Archived Books </h1>
        <h1> x{{ $ab }} </h1>
        </div>
      </div>
<footer>
  <p>Created By: John Henly A. Montera<br>
  <a href="https://henly09.github.io/MyPortfolio/" target="_blank">Montera™ 2022</a></p>
</footer>  
</center>
</body>
</html>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<style>

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

.logged2{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  position: absolute;
  font-size: 16px;
  right: 65%;
  top: 195px;
  padding: 5px;
  border-radius: 5px;
  background-color: #f4645c;
}

.logo{
  height: 80px;
  width: 80px;
  margin-right: 15px;
  margin-top: -20px;
}

footer{
  margin-top:12%;
  background-color: #ceb396;
  padding: 15px 0px 15px 0px;
  border-radius: 5px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
}

center{
  margin-top: 5px;
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
  text-decoration: none;
}


.mainname{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  margin-top: 50px;
  font-size: 40px;
  width:265px;
  text-shadow: 2px 2px #f9eebd;
  box-shadow: 0px 4px 2px -2px rgba(0,0,0,0.5);
}

.header{
  display: flex; 
  justify-content: center; 
  padding-top: 30px;
}

a.nav{
  padding:10px;
  font-size:18px;
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  transition: 0.3s;
  border-radius:5px;
  text-decoration: none;
}

a.nav:hover{
  padding:10px;
  font-size:18px;
  font-family: 'Arial';
  font-weight: bold;
  color: white;
  background-color:#343434;
  transition: 0.3s;
}

a.navlogout{
  padding:10px;
  font-size:18px;
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  transition: 0.3s;
  border-radius:5px;
  text-decoration: none;
}

a.navlogout:hover{
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

.card > h1{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  text-shadow: 0.5px 0.5px #efb79d;
}

.flex-container {
  display: inline-flex;
}

.flex-container > div {
  background-color: #d4dc64;
  margin: 10px;
  padding: 20px;
  font-size: 12px;
  border-radius: 5px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
  
}

div.card {
    flex-direction: column;
}

.header > h3{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
}

</style>

