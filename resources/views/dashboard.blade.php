<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
</head>
<center>
<nav class="navbar navbar-inverse">

    <div class="header">   
      <a style="margin-right: 25%;" class="navbar-brand" href="{{ route('dashboard')}}">LIBRARY MANAGEMENT SYSTEM</a>
      <h3 class="logged"> Account Logged: {{ $name }} </h3>
    </div>

    <ul class="nav navbar-nav">
      <a class='nav' href="{{ route('dashboard')}}">DASHBOARD</a>
      <a class='nav' href="{{ route('books')}}">BOOKS</a>
      <a class='nav' href="{{ route('borrower')}}">BORROWERS</a>
      <a class='nav' href="{{ route('notreturnedbooks')}}">NOT RETURNED BOOKS</a>
      <a class='nav' href="{{ route('borrow')}}">ISSUE BOOK BORROW</a>
      <a class='nav' href="{{ route('transactionhistory')}}">TRANSACTION HISTORY</a>
      <a class='nav' href="{{ route('logout')}}">LOGOUT</a>
    </ul>
</nav>
</center>
<body style='background-color: #56f0ba' class="body">  
  <center>
    <h1 class="mainname"> DASHBOARD </h1>

      <div class="flex-container">
        <div class="card">
        <h1> No. of Accounts </h1>
        <h1> {{ $acccount }} </h1>
        </div>
        <div class="card">
        <h1> No. of Available Books </h1>
        <h1> {{ $bookcount }} </h1>
        </div>
        <div class="card">
        <h1> No. of Borrower Acc </h1>
        <h1> {{ $borrowercount }} </h1>
        </div>
      </div> 
      
      <div class="flex-container">
        <div class="card">
        <h1> No. of All Transactions </h1>
        <h1> {{ $historycount }} </h1>
        </div>
        <div class="card">
        <h1> No. of Borrowed Books </h1>
        <h1> {{ $transactioncount }} </h1>
        </div>
        <div class="card">
        <h1> No. of Not Returned Books </h1>
        <h1> {{ $notreturnedcount }} </h1>
        </div>
      </div>
<footer>
  <p>Created By: John Henly A. Montera<br>
  <a href="https://henly09.github.io/MyPortfolio/">Montera™ 2022</a></p>
</footer>  
</center>
</body>
</html>

<style>

footer{
  margin-top:10%;
  width: 100%;
  background-color: #348c4c;
  padding: 15px 0px 15px 0px;
  border-radius: 5px;
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
}


.mainname{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
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

.card > h1{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
}

.flex-container {
  display: inline-flex;
}

.flex-container > div {
  background-color:#328f49;
  margin: 10px;
  padding: 20px;
  font-size: 10px;
  border-radius: 10px;
  border: 2px solid black;
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

