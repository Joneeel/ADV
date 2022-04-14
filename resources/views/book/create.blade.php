<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="{{ asset('Image/libraryicon.ico') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD NEW BOOK (LMS) </title>
</head>
<center>
<nav class="navbar navbar-inverse">

<div class="header">
     <img class="logo" src="{{ asset('Image/logo.png') }}"/>   
      <a style="margin-right: 200px; text-decoration: none;text-shadow: 2px 2px gray;" class="navbar-brand" href="{{ route('dashboard')}}">LIBRARY MANAGEMENT SYSTEM</a>
      <div class="dropdown">
      <button class="dropbtn">👤 Account Logged: {{ $name }}</button>
      <div class="dropdown-content">
      <a href="{{ route('displaychangepass') }}">Change Password</a>
      </div>
      </div>
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
<body style='background-color: #fd9459'>  
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="mainname">CREATE BOOK</h2>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form class="yourform" action="{{ route('bookcreateprocess')}}" method="any" autocomplete="off">
                    @csrf
                    <div>
                        <label>Title: </label>
                        <input type="text" class="inputs" name="Title" value="" required>
                    </div>

                    <div>
                        <label>Author: </label>
                        <input type="text" class="inputs" name="Author" value="" required>
                    </div>

                    <div>
                        <label>Copyright: </label>
                        <input type="text" class="inputs" name="Copyright" value="" required>
                    </div>

                    <div>
                    <label>Type: </label>
                        <select id="typeid" class="inputs" name="type" required>
                                <option value=""> Select Type... </option>
                                <option value="Fiction">Fiction</option>
                                <option value='NonFiction'>Non Fiction</option>
                      </select>
                  </div>

                    <div>
                      <label>Category: </label>
                      <select id="categoryid" class="inputs" name="category" required>
                      </select>
                    </div>

                    <div>
                        <label>No_Pages: </label>
                        <input type="number" class="inputs" name="No_Pages" value="" required>
                    </div>

                    <div>
                        <label>No_Stock: </label>
                        <input type="number" class="inputs" name="No_Stock" value="" required>
                    </div>

                    <input class="button" type="submit" name="submit" class="btn btn-danger" value="Create" required>

                </form>
            </div>
        </div>
    </div>
</div>
</body>
</center>
</html>
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
}

.logo{
  height: 80px;
  width: 80px;
  margin-right: 15px;
  margin-top: -20px;
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

