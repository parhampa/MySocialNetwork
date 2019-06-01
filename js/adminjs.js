function visiblepost(id) {

    $.ajax({
        url: "vipost.php?id=" + id + "&vi=1",
        ids: id,
        type: 'get',
        success: function (data) {
            var btnid = "unvisiblepost" + id;
            document.getElementById(btnid).style.display = "";
            var btnid = "visiblepost" + id;
            document.getElementById(btnid).style.display = "none";
        }
    });
}

function unvisiblepost(id) {

    $.ajax({
        url: "vipost.php?id=" + id + "&vi=0",
        ids: id,
        type: 'get',
        success: function (data) {
            var btnid = "unvisiblepost" + id;
            document.getElementById(btnid).style.display = "none";
            var btnid = "visiblepost" + id;
            document.getElementById(btnid).style.display = "";
        }
    });
}

function showaddcat() {
    document.getElementById('addcat').style.display = 'block';
    document.getElementById('addcatplc').style.display = "";
    document.getElementById('addselcatplc').style.display = "none";
    document.getElementById('addnumericplc').style.display = "none";
    document.getElementById('addstringplc').style.display = "none";
}

function docat(catid, cat_title, cat_father, cat_order) {
    document.getElementById('father').value = cat_father;
    document.getElementById('cat_ord').value = cat_order;
    document.getElementById('title').value = cat_title;
    document.getElementById('editcat').style.display = "";
    document.getElementById('deletecat').style.display = "";
    document.getElementById('addselitem').style.display = "";
    document.getElementById('addnumericitem').style.display = "";
    document.getElementById('addstringitem').style.display = "";
    pubcatid = catid;
}

function showaddselcatpg() {
    document.getElementById('addcatplc').style.display = "none";
    document.getElementById('addselcatplc').style.display = "";
    document.getElementById('addselcat_id').value = pubcatid;
}

function showaddnumericplc() {
    document.getElementById('addcatplc').style.display = "none";
    document.getElementById('addnumericplc').style.display = "";
    document.getElementById('numericcatid').value = pubcatid;
}

function showstringplc() {
    document.getElementById('addcatplc').style.display = "none";
    document.getElementById('addstringplc').style.display = "";
    document.getElementById('addstringcatid').value = pubcatid;
}

function addselectitem() {
    $.post("addselitem.php?dodo=1",
        {
            cat_id: document.getElementById('addselcat_id').value,
            title: document.getElementById('addseltitle').value,
            sel_order: document.getElementById('addsel_order').value
        },
        function (data, status) {
            myobj = JSON.parse(data);
            alert(myobj.pm);
        });
}

function addstringitem() {
    $.post("addstringitem.php",
        {
            stringimportant: document.getElementById('stringimportant').value,
            cat_id: document.getElementById('addstringcatid').value,
            title: document.getElementById('addstringtitle').value,
            order_string: document.getElementById('addstringorder').value,
            bigtext: document.getElementById('stringtextarea').value
        },
        function (data, status) {
            myobj = JSON.parse(data);
            alert(myobj.pm);
        });
}

function addcat() {
    $.post("addcat.php",
        {
            cat_ord: document.getElementById('cat_ord').value,
            father: document.getElementById('father').value,
            title: document.getElementById('title').value
        },
        function (data, status) {
            myobj = JSON.parse(data);
            loadfcat();
            alert(myobj.pm);
        });
}

function addnumericitem() {
    $.post("addnumericitem.php",
        {
            cat_id: document.getElementById('numericcatid').value,
            title: document.getElementById('numerictitle').value,
            orderval: document.getElementById('numericorderval').value,
            important: document.getElementById('numericimportant').value,
            ismoney: document.getElementById('numericmoney').value
        },
        function (data, status) {
            myobj = JSON.parse(data);
            alert(myobj.pm);
        });
}

function editcat() {
    $.post("addcat.php?update=" + pubcatid,
        {
            cat_ord: document.getElementById('cat_ord').value,
            father: document.getElementById('father').value,
            title: document.getElementById('title').value
        },
        function (data, status) {
            myobj = JSON.parse(data);
            loadfcat();
            loadscat();
            alert(myobj.pm);
        });
}

function deletecat() {
    $.post("addcat.php?delete=" + pubcatid,
        {
            cat_ord: document.getElementById('cat_ord').value,
            father: document.getElementById('father').value,
            title: document.getElementById('title').value
        },
        function (data, status) {
            myobj = JSON.parse(data);
            loadfcat();
            loadscat();
            alert(myobj.pm);
        });
}

function loadfcat() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("father").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "loadfcat.php", true);
    xhttp.send();
}

function loadscat() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("catplc").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "loadfcat.php?scat=1", true);
    xhttp.send();
}
function addselectitemfunc() {
    $.post("add_selectitem.php",
        {
            sid: document.getElementById('adminselectid').value,
            title: document.getElementById('adminadditiontitle').value
        },
        function (data, status) {
            myobj = JSON.parse(data);
            /*document.getElementById('postform1').style.display = "none";
            document.getElementById('postform2').style.display = "";*/
            showform2(document.getElementById('add_subcat').value);
            alert(myobj.pm);
        });
}