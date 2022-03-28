<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="{{ asset('Image/libraryicon.ico') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<center>
<body style="background-color:#0cbcb4">
        <form class="" action="{{ route('signupvalidation') }}" method="get"> 
        <img  style="width:150px;height:150px;margin-top: 20px;" src="{{ asset('Image/library.gif') }}" alt="">
            @csrf 
            <h1 class="title" style="margin-top: 20px"> REGISTRATION FOR ADMIN IN <br> LIBRARY MANAGEMENT SYSTEM </h1>

            <div>
                <label> NAME: </label>
                <input class="inputs" style="margin-top: 20px;" type="text" name="name" class="form-control" value="" placeholder="Your Fullname.." required>
            </div>
            <div>
                <label> USERNAME: </label>
                <input class="inputs" style="margin-top: 20px;" type="text" name="username" class="form-control" value="" placeholder="Your Username.." required>
            </div>
            <div>
                <label> PASSWORD: </label>
                <input class="inputs" style="margin-top: 20px;" type="password" name="password" class="form-control" value=""  placeholder="Your Password.." required>
            </div>
            <div>
                <label> CONFIRM PASSWORD: </label>
                <input class="inputs" style="margin-top: 20px;" type="password" name="password_confirmation" class="form-control" value=""  placeholder="Confirm Your Password.." required>
            </div>
            <input class="button" style="margin-top: 20px" type="submit" name="signup" class="btn btn-danger" value="Sign Up"/>
        </form>
        <h1> </h1>
        <a> Already have an Account <a href="{{ route('login')}}"> Login Already! </a></a>
        <h1> </h1>
        <div class="message"> {{ $message }}</div>
</body>
</center>
</html>

<style>

.message{
    font-family: 'Arial';
  font-weight: bold;
}

.title{
  font-size:40px;
  font-family: 'Arial';
  font-weight: bold;
}

label{
  font-family: 'Arial';
  font-weight: bold;
}

a{ 
  font-family: 'Arial';
  font-weight: bold;
}

.message{
  font-family: 'Arial';
  font-weight: bold;
}

.button {
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

.inputs {
  width: 20%;
  padding: 5px 10px;
  margin: 8px 0;
  box-sizing: border-box;
  border-radius: 5px;
}

</style>