<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKS</title>
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
  <center>
  <body style='background-color: #56f0ba'>  
  <div style="display: inline-flex;">
    <h1 class="mainname"> BOOKS </h1>
      <a href="{{ route('bookcreate') }}" class="addnewbook"> CREATE NEW BOOK </a>
    </form>
  </div>
<table>
  <tr>
    <th>Book_id</th>
    <th>Title</th>
    <th>Author</th>
    <th>Copyright</th>
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
    <td>{{ $data->No_pages }}</td>
    <td>{{ $data->Stock }}</td>
    <td class="editbutton">
      <form action="{{ route('bookedit',$data->Book_id)}}" method="post" class="form-hidden">
        <button>Edit</button>
        @csrf
      </form>
    </td>
    <td class="deletebutton">
      <form action="{{ route('bookdelete', $data->Book_id) }}" method="post" class="form-hidden">
        <button >Delete</button>
        @csrf
      </form>
    </td>
  </tr>
  @endforeach
</table>
</center>
</body>
</html>

<style>

.addnewbook{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  position: absolute;
  margin-left: 29%;
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
  font-family: 'Arial';
  font-weight: bold;
  margin-top:15px;
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

.logged{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
}
</style>

