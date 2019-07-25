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
