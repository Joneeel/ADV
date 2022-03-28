<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="{{ asset('Image/libraryicon.ico') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<center>
<body style="background-color:#0cbcb4">
        <form class="" action="{{ route('loginvalidation') }}" method="get">
        <img  style="width:150px;height:150px;margin-top: 20px;" src="{{ asset('Image/library.gif') }}" alt="">
            @csrf 
            <h1 class="title" style="margin-top: 20px;" > LIBRARY MANAGEMENT SYSTEM </h1>
            <div>
                <label> USERNAME: </label>
                <input class="inputs" type="text" name="username" class="form-control" value="{{ old('username')}}" placeholder="Your Username.." required>
            </div>
            <h1> </h1>
            <div>
                <label> PASSWORD: </label>
                <input class="inputs" type="password" name="password" class="form-control" value="" placeholder="Your Password.." required>
            </div>
            <input class="button" style="margin-top: 20px;" type="submit" name="login" class="btn btn-danger" value="Login"/>
        </form>
        <h1> </h1>
        <a> Don't Have an Account? <a href="{{ route('signup')}}"> Sign Up </a></a>
        <h1> </h1>
        <div class="message" > {{ $message }} </div>
</body>
</center>
</html>

<style>

.title{
  font-size:40px;
  font-family: 'Arial';
  font-weight: bold;
  padding-bottom: 5px;
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