<?php
include("config.php");
?>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/w3.css">
    <script src="js/jquery.min.js"></script>
    <script>
        function showreg() {
            document.getElementById("loginform").style.display = "none";
            document.getElementById("regform").style.display = "";
        }

        function showlogin() {
            document.getElementById("loginform").style.display = "";
            document.getElementById("regform").style.display = "none";
            //document.getElementById("regaut").style.display = "none";
        }

        function reguser() {
            $.post("add_user.php",
                {
                    user: document.getElementById('ruser').value,
                    pass: document.getElementById('rpass').value,
                    pass1: document.getElementById('rpass2').value,
                    email: document.getElementById('remail').value,
                    mobile: document.getElementById('rmobile').value,
                    name1: document.getElementById('rname').value,
                    family1: document.getElementById('rfamily').value,
                    city: document.getElementById('rcity').value
                },
                function (data, status) {
                    myobj = JSON.parse(data);
                    document.getElementById('txtres').innerHTML = myobj.pm;
                    if (myobj.type == 0) {
                        document.getElementById('msgres').classList.remove("w3-green");
                        document.getElementById('msgres').classList.add("w3-red");
                    } else {
                        document.getElementById('msgres').classList.remove("w3-red");
                        document.getElementById('msgres').classList.add("w3-green");

                        document.getElementById('regform').style.display = 'none';
                        document.getElementById('loginform').style.display = '';
                    }
                    document.getElementById('msgres').style.display = '';
                });
        }

        function ulogin() {
            $.post("login.php",
                {
                    username: document.getElementById('lusername').value,
                    password: document.getElementById('lpassword').value
                },
                function (data, status) {
                    myobj = JSON.parse(data);
                    document.getElementById('txtres').innerHTML = myobj.pm;
                    if (myobj.type == 0) {
                        document.getElementById('msgres').classList.remove("w3-green");
                        document.getElementById('msgres').classList.add("w3-red");
                    } else {
                        document.getElementById('msgres').classList.remove("w3-red");
                        document.getElementById('msgres').classList.add("w3-green");
                        setTimeout(function () {
                            location.replace("main.php")
                        }, 1000);


                    }
                    document.getElementById('msgres').style.display = '';
                });
        }
    </script>
</head>
<body class="backload">
<div class="w3-panel w3-display-container" style="display: none;" id="msgres">
  <span onclick="this.parentElement.style.display='none'"
        class="w3-button w3-large w3-display-topright">&times;</span>
    <h3>result</h3>
    <p id="txtres"></p>
</div>
<div style="width: 100%;" id="loginform" class="w3-animate-right">
    <div id="login" style="text-align: center; width: 60%; margin-left: 20%;">
        <div id="login" style="text-align: center; width: 90%; margin-left: 5%;" class="w3-panel w3-card-4 w3-white">
            <br>
            <form>
                <input type="text" name="username" id="lusername" placeholder="username" class="w3-input w3-border"><br>
                <input type="password" name="password" id="lpassword" placeholder="password" class="w3-input w3-border"><br>
                <input type="button" value="login" class="w3-btn w3-blue" style="width: 90%;" onclick="ulogin()">
            </form>
        </div>
    </div>
    <div style="text-align: center; width: 70%; margin-left: 15%;" class="w3-white">
        Don't have an account? <span style="color: #2196F3;" onclick="showreg()">Sign up</span>
    </div>
</div>

<div style="width: 100%; display: none;" id="regform" class="w3-animate-left">
    <div style="text-align: center; width: 80%; margin-left: 10%;" class="w3-panel w3-card-4 w3-white">
        <div id="login" style="text-align: center; width: 90%; margin-left: 5%;">
            <br>
            <form>
                <input type="text" name="user" id="ruser" placeholder="your username" class="w3-input w3-border"><br>
                <input type="password" name="pass" id="rpass" placeholder="your password" class="w3-input w3-border"><br>
                <input type="password" name="pass2" id="rpass2" placeholder="your password again" class="w3-input w3-border"><br>
                <input type="email" name="email" id="remail" placeholder="your email" class="w3-input w3-border"><br>
                <input type="text" name="mobile" id="rmobile" placeholder="your mobile number" class="w3-input w3-border"><br>
                <input type="text" name="name" id="rname" placeholder="your name" class="w3-input w3-border"><br>
                <input type="text" name="family" id="rfamily" placeholder="your family" class="w3-input w3-border"><br>
                <input type="text" name="city" id="rcity" placeholder="your city" class="w3-input w3-border"><br>
                <input type="button" id="regbtn" value="sign up" class="w3-btn w3-blue" onclick="reguser();"
                       style="width: 90%;">
            </form>
        </div>
    </div>
    <div style="text-align: center; width: 70%; margin-left: 15%;" class="w3-white">
        Have an account? <span style="color: #2196F3;" onclick="showlogin()">Log in</span>
    </div>
</div>

</body>
</html>
