<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="{{ asset('Image/libraryicon.ico') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISSUE NEW BOOK (LMS) </title>
</head>
<center>
<nav class="navbar navbar-inverse">

<div class="header">
     <img class="logo" src="{{ asset('Image/logo.png') }}"/>   
      <a style="margin-right: 25%; text-decoration: none;" class="navbar-brand" href="{{ route('dashboard')}}">LIBRARY MANAGEMENT SYSTEM</a>
      <h3 class="logged"> Account Logged: {{ $name }} </h3>
    </div>

    <ul class="nav navbar-nav">
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
  <center>
<body style='background-color: #56f0ba'>  
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="mainname">NEW ISSUED BOOK</h2>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form class="yourform" action="{{ route('issue') }}" method="post" autocomplete="off">
                    @csrf
                    <div>
                        <label>Borrower's Name: </label>
                        <select class="inputs" name="borrower_id" required>
                                <option value="">Select Name</option>
                                @foreach ($borrower as $borrowers)
                                    <option value='{{ $borrowers->Borrower_id }}'>{{ $borrowers->fullname }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div>
                        <label>Book's Name: </label>
                        <select class="inputs" name="book_id" required>
                                <option value="">Select Book</option>
                                @foreach ($books as $book)
                                    <option value='{{ $book->Book_id }}'>{{ $book->Title }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div>
                        <label>Due Date: </label>
                        <input type="number" class="inputs" name="days" value="7" required>
                    </div>
                   <input class="button" type="submit" name="submit" class="btn btn-danger" value="Create Issue" required>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</center>
</html>

<style>

.logo{
  height: 5%;
  width: 5%;
  margin-right: 15px;
  margin-top: -20px;
}

.logged{
   background-color: #70f72d;
   padding: 10px;
   margin-top: -7px;
   border-radius: 10px;
   border: 2px solid black;
}

.mainname{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  font-size: 40px;
}

label{
  font-family: 'Arial';
  font-weight: bold;
}

.button {
  margin: 20px;
  background-color: #4CAF50; 
  border: none;
  color: white;
  padding: 15px 32px;
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
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  transition: 0.3s;
}

.header{
  display: flex; 
  justify-content: center; 
  padding-top: 30px;
}


.inputs {
  width: 20%;
  padding: 5px 10px;
  margin: 8px 0;
  box-sizing: border-box;
  border-radius: 5px;
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
  background-color:black;
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

