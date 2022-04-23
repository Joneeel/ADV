<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="{{ asset('Image/libraryicon.ico') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP  (LMS) </title>
</head>
<center>
<body style="background-color: #88dad5">
<div style="display: inline-flex; margin-top: 60px;">
    <svg width="100" height="100" class="eyeleft">  
        <circle cx="50" cy="50" r="50" fill="white" class="eyeball_left" />
        <circle cx="50" cy="50" r="20" fill="#0D0D20" class="pupil_left" />
    </svg>
    <svg width="100" height="100" class="eyeright">
      <circle cx="50" cy="50" r="50" fill="white" class="eyeball_right" />
      <circle cx="50" cy="50" r="20" fill="#0D0D20" class="pupil_right" />
    </svg>
</div>
        <form class="" action="{{ route('signupvalidation') }}" method="any">

            @csrf 
            <div style="display: inline-flex; margin-left: -5%; ">
            <img class="logo" src="{{ asset('Image/logo.png') }}"/>
            <h1 class="title"> REGISTRATION FOR ADMIN IN <br> LIBRARY MANAGEMENT SYSTEM </h1>
            </div>
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
        <a> Already have an Account <a class="link" href="{{ route('login')}}"> Login Already! </a></a>
        <h1> </h1>
        @if(!empty($message))
        <div class="message"> Message: <br>  {{ $message }}</div>
        @endif
</body>
</center>
</html>

<script>
    let eyeball_left = document.querySelector(".eyeball_left"),
    pupil_left = document.querySelector(".pupil_left"),
    eyeArea_left = eyeball_left.getBoundingClientRect(),
    pupil_leftArea = pupil_left.getBoundingClientRect(),
    R_left = eyeArea_left.width/2,
    r_left = pupil_leftArea.width/2,
    centerX_left = eyeArea_left.left + R_left,
    centerY_left = eyeArea_left.top + R_left;

    let eyeball_right = document.querySelector(".eyeball_right"),
    pupil_right = document.querySelector(".pupil_right"),
    eyeArea_right = eyeball_right.getBoundingClientRect(),
    pupil_rightArea = pupil_right.getBoundingClientRect(),
    R_right = eyeArea_right.width/2,
    r_right = pupil_rightArea.width/2,
    centerX_right = eyeArea_right.left + R_right,
    centerY_right = eyeArea_right.top + R_right;

document.addEventListener("mousemove", (e)=>{
  let x_left = e.clientX - centerX_left,
      y_left = e.clientY - centerY_left,
      theta_left = Math.atan2(y_left,x_left),
      angle_left = theta_left*180/Math.PI + 360;

  let x_right = e.clientX - centerX_right,
      y_right = e.clientY - centerY_right,
      theta_right = Math.atan2(y_right,x_right),
      angle_right = theta_right*180/Math.PI + 360;


  pupil_left.style.transform = `translateX(${R_left - r_left +"px"}) rotate(${angle_left + "deg"})`;
  pupil_left.style.transformOrigin = `${r_left +"px"} center`;

  pupil_right.style.transform = `translateX(${R_right - r_right +"px"}) rotate(${angle_right + "deg"})`;
  pupil_right.style.transformOrigin = `${r_right +"px"} center`;

});
</script>

<style>

.link{
  text-decoration: none;
}

.logo{
  height: 120px;
  width: 120px;
  padding-right: 20px;
  margin-top: 15px;
}

.eyeright{
  padding-left: 5px;
}
.eyeleft{
  padding-right: 5px;
}
.pupil_left{
    position:relative;
  }
.pupil_right{
    position:relative;
}

body{
  margin-bottom: 15%;
}

.message{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  border-radius: 10px;
  background-color: #4CAF50;
  font-size: 16px;
  width: 20%;
  margin-top: 2%;
  padding: 5px;
  border: 2px solid black;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
}

.title{
  font-size:40px;
  font-family: 'Arial';
  font-weight: bold;
  text-shadow: 3px 3px white;
}

label{
  font-family: 'Arial';
  font-weight: bold;
}

a{ 
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
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
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
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
}

</style>