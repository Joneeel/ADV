<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="{{ asset('Image/libraryicon.ico') }}">
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
      <a class='navi' href="{{ route('dashboard')}}">DASHBOARD</a>
      <a class='navi' href="{{ route('books')}}">BOOKS</a>
      <a class='navi' href="{{ route('borrower')}}">BORROWERS</a>
      <a class='navi' href="{{ route('notreturnedbooks')}}">NOT RETURNED BOOKS</a>
      <a class='navi' href="{{ route('borrow')}}">ISSUE BOOK BORROW</a>
      <a class='navi' href="{{ route('transactionhistory')}}">TRANSACTION HISTORY</a>
      <a class='navi' href="{{ route('logout')}}">LOGOUT</a>
    </ul>
</nav>
</center>
  <center>
  <body style='background-color: #56f0ba'> 
  <div style="display: inline-flex;">
    <h1 class="mainname"> BOOKS </h1>
      <a href="{{ route('bookcreate') }}" class="addnewbook"> CREATE NEW BOOK </a>
      <h2 class='logged2'> {{ $message }} </h2> 
    </form>
  </div>
  <form action="{{ route('searchbook') }}" method="post">
    @csrf 
      <div class="searcholder">
        <label class='search'> Search: </label>
        <input class="inputs" type="text" name="searchtitle" class="form-control" value="" placeholder="Search for the Title of the Book.." required>
        <input class="button" style="margin-top: 20px;" type="submit" name="login" class="btn btn-danger" value="Search"/>
       </div>
  </form>
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
<footer>
  <p>Author: John Henly A. Montera<br>
  <a href="https://henly09.github.io/MyPortfolio/">Montera™ 2022</a></p>
</footer>
</center>
</body>
</html>

<style>

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
  position: absolute;
  margin-top:30%;
  width: 99%;
  background-color: #348c4c;
  padding: 15px 0px 15px 0px;
  border-radius: 5px;
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
  right: 65%;
  margin-top: 20px;
  padding: 12px 12px;
}

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

