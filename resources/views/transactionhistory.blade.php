<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANSACTION HISTORY</title>
</head>
<center>
<nav class="navbar navbar-inverse">

    <div class="header">   
      <a class="navbar-brand" style="margin-right: 25%;" href="{{ route('dashboard')}}">LIBRARY MANAGEMENT SYSTEM</a>
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

<body style='background-color: #56f0ba'>  
  <center>
    <h1 class="mainname"> TRANSACTION HISTORY </h1>
<table>
  <tr>
    <th>History_id</th>
    <th>Book_id</th>
    <th>Borrower_id</th>
    <th>Date_Returned</th>
    <th>Date_Borrowed</th>
    <th>Created_at</th>
    <th>Updated_at</th>
  </tr>
  @foreach($historys as $key => $data)
  <tr>
    <td>{{ $data->History_id }}</td>
    <td>{{ $data->Book_id }}</td>
    <td>{{ $data->Borrower_id }}</td>
    <td>{{ $data->Date_Returned }}</td>
    <td>{{ $data->Date_Borrowed }}</td>
    <td>{{ $data->Created_at }}</td>
    <td>{{ $data->Updated_at }}</td>
  </tr>
  @endforeach
</table>
</center>
</body>
</html>

<style>

.mainname{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
}

table, th, td {
  border: 2px solid black;
  text-align:center;
  padding:10px;
  font-size:15px;
  font-family: 'Arial';
  font-weight: bold;
}

.header{
  display: flex; 
  justify-content: center; 
  padding-top:30px
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

.logged{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
}
</style>

