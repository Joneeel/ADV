<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="{{ asset('Image/libraryicon.ico') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login  (LMS) </title>
</head>
<center>
<body class="bg">
<div class="imagebg"> 
<div class="inputbg">
<div style="display: inline-flex;">
    <svg width="100" height="100" class="eyeleft">  
        <circle cx="50" cy="50" r="50" fill="white" class="eyeball_left" />
        <circle cx="50" cy="50" r="20" fill="#0D0D20" class="pupil_left" />
    </svg>
    <svg width="100" height="100" class="eyeright">
      <circle cx="50" cy="50" r="50" fill="white" class="eyeball_right" />
      <circle cx="50" cy="50" r="20" fill="#0D0D20" class="pupil_right" />
    </svg>
</div>
        <form action="{{ route('loginvalidation') }}" method="any">
            @csrf 
            <h1 class="title"> <img class="logo" src="{{ asset('Image/logo.png') }}"/> LIBRARY MANAGEMENT SYSTEM </h1>
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
        <a> Don't Have an Account? <a class="link" href="{{ route('signup')}}"> Sign Up </a></a>
        <?php
            $datetoday = date("Y/m/d");
            $lastday = date("Y-m-d", strtotime($datetoday));
        ?>
        @if($datetoday == $lastday)
        <div class="message" > Message: <br> Report All the Violations of Borrowers <br> accounts in the finance! </div>
        @endif
        @if(!empty($message))
        <div class="message" > Message: <br> {{ $message }} </div>
        @endif
        </div>
        </div>
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

.inputbg{
  margin-top: 100px;
  background-color:rgba(136, 218, 213, 0.8) ;
  width: 80%;
  padding: 45px 0px 85px 0px;
  border-radius: 20px;
}

.imagebg{
    -webkit-border-radius: 15px;
    -moz-border-radius: 15px;
    background-image: url("{{ asset('Image/bg1.png') }}");
    background-repeat: no-repeat;
    background-size: cover;
    padding-top: 0.5%;
    padding-bottom: 5%;
    background-position:center;
    box-shadow: inset 0px 8px 16px 0px rgba(0,0,0,0.5);
    padding-bottom: 300px;
  }

.link{
  text-decoration: none;
}

.logo{
  height: 85px;
  width: 85px;
  margin-bottom: -22px;
  padding-right: 10px;
}

form{
  margin-bottom: 20px;
}

.bg{
  background-color: #88dad5;
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


.title{
  font-size:40px;
  font-family: 'Arial';
  font-weight: bold;
  padding-bottom: 5px;
  text-shadow: 3px 3px white;
}

.title2{
  font-size:20px;
  font-family: 'Arial';
  font-weight: bold;
  padding-bottom: 5px;
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
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
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