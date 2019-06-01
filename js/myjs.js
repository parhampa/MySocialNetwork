function delpic(id) {
    var itemid = "imagepost" + id;
    var countitem = document.getElementsByClassName(itemid).length;
    for (i = 0; i < countitem; i++) {
        if (document.getElementsByClassName(itemid)[i].style.display == "") {
            var pic = document.getElementsByClassName(itemid)[i].src;
            pic = pic.substr(pic.indexOf("uploads"), pic.length);
            $.post("delpic.php",
                {
                    pic: pic
                },
                function (data, status) {
                    location.replace("main.php");
                });
        }
    }
}

function upmorpic(id) {
    uploadnumber = 0;
    addedpostid = id;
    document.getElementById('postform1').style.display = 'none';
    document.getElementById('postform2').style.display = 'none';
    document.getElementById('postform3').style.display = '';
    document.getElementById('addpost').style.display = 'block';
}

function showmorepost(id) {
    $.ajax({
        url: "morepost.php?id=" + id,
        ids: id,
        type: 'get',
        success: function (data) {
            var res = "morpostid" + id;
            document.getElementById(res).innerHTML = data;
            document.getElementById(res).style.display = "";
            document.getElementById("btnshmor" + id).style.display = "none";
            document.getElementById("btnhimor" + id).style.display = "";
        }
    });
}

function hidemorepost(id) {
    var res = "morpostid" + id;
    document.getElementById(res).style.display = "none";
    document.getElementById("btnshmor" + id).style.display = "";
    document.getElementById("btnhimor" + id).style.display = "none";
}

if (document.getElementById('mainpart').clientWidth < 300) {
    var ptlen = document.getElementsByClassName('postmain').length;
    for (i = 0; i < ptlen; i++) {
        document.getElementsByClassName('postmain')[i].style.width = "100%";
        document.getElementsByClassName('postmain')[i].style.marginLeft = "0";
        document.getElementsByClassName('postcontent')[i].style.width = "100%";
        document.getElementsByClassName('postcontent')[i].style.marginLeft = "0";
    }
}

function showslide(slideitem, postid) {
    var imgclasspost = "imagepost" + postid;
    var postpiccount = document.getElementsByClassName(imgclasspost).length;
    for (i = 0; i < postpiccount; i++) {
        document.getElementsByClassName(imgclasspost)[i].style.display = "none";
    }
    var imageitemcls = "imagepostnumber" + postid + "-" + slideitem;
    document.getElementsByClassName(imageitemcls)[0].style.display = "";
}

function editmortxt(oldid, postid) {
    $.post("isthisuser.php",
        {
            id: postid
        },
        function (data, status) {
            myobj = JSON.parse(data);
            if (myobj.res == 1) {
                var id = "strid" + oldid;
                var paramval = document.getElementById(id).innerHTML;
                document.getElementById(id).onclick = "";
                document.getElementById(id).innerHTML = "<input style='width: 100%' type='text' id='t" + id + "' value='" + paramval + "'><input type='button' value='save' onclick='savetxt(" + oldid + "," + postid + ")'><input onclick='canseledotmortxt(" + oldid + "," + postid + ")' type='button' value='cancel'>";

            }
        });
}

function editmortxtarea(oldid, postid) {
    $.post("isthisuser.php",
        {
            id: postid
        },
        function (data, status) {
            myobj = JSON.parse(data);
            if (myobj.res == 1) {
                var id = "strid" + oldid;
                var paramval = document.getElementById(id).innerHTML;
                document.getElementById(id).onclick = "";
                document.getElementById(id).innerHTML = "<textarea style='width: 100%;' id='t" + id + "'>" + paramval + "</textarea><input type='button' value='save' onclick='savetxt(" + oldid + "," + postid + ")'><input onclick='canseledotmortxt(" + oldid + "," + postid + ")' type='button' value='cancel'>";
            }
        });
}

function canseledotmortxt(oldid, postid) {
    showmorepost(postid);
}

function savetxt(id, postid) {
    var txtid = "tstrid" + id;
    var valuee = document.getElementById(txtid).value;
    $.post("saveitem.php",
        {
            id: id,
            valuee: valuee,
            str: 1
        },
        function (data, status) {
            showmorepost(postid);
        });
}

function editmornumber(oldid, postid) {
    $.post("isthisuser.php",
        {
            id: postid
        },
        function (data, status) {
            myobj = JSON.parse(data);
            if (myobj.res == 1) {
                var id = "numid" + oldid;
                var paramval = document.getElementById(id).innerHTML;
                document.getElementById(id).onclick = "";
                document.getElementById(id).innerHTML = "<input style='width: 100%' type='number' id='n" + id + "' value='" + paramval + "'><input type='button' value='save' onclick='savenumber(" + oldid + "," + postid + ")'><input onclick='canseledotmornumeric(" + oldid + "," + postid + ")' type='button' value='cancel'>";
            }
        });
}

function canseledotmornumeric(oldid, postid) {
    showmorepost(postid);
}

function savenumber(id, postid) {
    var txtid = "nnumid" + id;
    var valuee = document.getElementById(txtid).value;
    $.post("saveitem.php",
        {
            id: id,
            valuee: valuee,
            numer: 1
        },
        function (data, status) {
            showmorepost(postid);
        });
}

function editselitems(id, postid) {
    $.post("isthisuser.php",
        {
            id: postid
        },
        function (data, status) {
            myobj = JSON.parse(data);
            if (myobj.res == 1) {
                $.get("showitemtxt.php",
                    {
                        id: id,
                        s: 1
                    },
                    function (data, status) {
                        var selspan = "selid" + id;
                        document.getElementById(selspan).innerHTML = data;
                        document.getElementById(selspan).onclick = "";
                    });
            }
        });
}

function canselsel(postid) {
    showmorepost(postid);
}

function savesel(id, postid) {
    var newid = "esel" + id;
    var valuee = document.getElementById(newid).value;
    $.post("saveitem.php",
        {
            id: id,
            valuee: valuee,
            selectt: 1
        },
        function (data, status) {
            showmorepost(postid);
        });
}

function selcitym() {
    document.getElementById('selcity').style.display = 'block';
}

function showcitysel() {
    var city = document.getElementById('selcityfilter').value;
    $.post("setcity.php",
        {
            city: city
        },
        function (data, status) {
            location.replace("main.php");
        });
}

function showcatlist() {
    document.getElementById('subparrentcats').style.display = 'none';
    document.getElementById('parrentcats').style.display = '';
    document.getElementById('categorylist').style.display = 'block';
}

function showsubcatlist(id) {
    $.post("subcatlist.php",
        {
            id: id
        },
        function (data, status) {
            document.getElementById('subparrentcats').innerHTML = data;
            document.getElementById('subparrentcats').style.display = '';
            document.getElementById('parrentcats').style.display = 'none';
        });
}

function filtercat(id) {
    var url = "main.php?scat=" + id;
    location.replace(url);
}

function addcityf() {
    $.post("addcity.php",
        {
            title: document.getElementById('addcityname').value,
            city_ord: document.getElementById('addcityorder').value
        },
        function (data, status) {
            myobj = JSON.parse(data);
            alert(myobj.pm);
        });
}

var pubcatid = 0;

function loadsubcat() {
    $.post("loadsubcat.php",
        {
            fcat: document.getElementById('add_fcat').value
        },

        function (data, status) {
            document.getElementById('subcatplace').innerHTML = data;
            document.getElementById('subcatplace').style.display = "";
        }
    )
    ;
}

function addanewpost() {
    document.getElementById('postform1').style.display = '';
    document.getElementById('postform2').style.display = 'none';
    document.getElementById('postform3').style.display = 'none';
    document.getElementById('addpost').style.display = 'block';
    document.getElementById('add_fcat').value = "";
    document.getElementById('add_subcat').value = "";
    document.getElementById('addmortxt').value = "";
    document.getElementById('progressbar').innerHTML = "0%";
    document.getElementById('progressbar').style.width = "0%";
    document.getElementById('subcatplace').style.display = "none";
    document.getElementById('morinfo').style.display = "none";

}

function loadmorinfo() {
    if (document.getElementById('add_subcat').value != 0) {
        document.getElementById('morinfo').style.display = "";
    }
    else {
        document.getElementById('morinfo').style.display = "none";
    }
}

var uploadnumber = 0;
var addedpostid;

function uploadFile(item) {
    selfile = document.getElementById('fileToUpload').files[item];
    if (item < document.getElementById('fileToUpload').files.length) {
        var fd = new FormData();
        fd.append("fileToUpload", selfile);
        var xhr = new XMLHttpRequest();
        xhr.upload.addEventListener("progress", uploadProgress, false);
        xhr.addEventListener("load", uploadComplete, false);
        xhr.addEventListener("error", uploadFailed, false);
        xhr.addEventListener("abort", uploadCanceled, false);
        xhr.open("POST", "up.php?id=" + addedpostid);
        xhr.send(fd);
    }
    else {
        alert("upload is finished");
        uploadnumber = 0;
    }
}

function uploadProgress(evt) {
    if (evt.lengthComputable) {
        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
        //document.getElementById('progressNumber').innerHTML = percentComplete.toString() + '%';
        document.getElementById('progressbar').innerText = percentComplete.toString() + '%';
        document.getElementById('progressbar').style.width = percentComplete.toString() + '%';

    }
    else {
        document.getElementById('progressNumber').innerHTML = 'unable to compute';
    }
}

function uploadComplete(evt) {
    /* This event is raised when the server send back a response */
    res = evt.target.responseText;
    uploadnumber++;
    uploadFile(uploadnumber);
}

function uploadFailed(evt) {
    alert("There was an error attempting to upload the file.");
}

function uploadCanceled(evt) {
    alert("The upload has been canceled by the user or the browser dropped the connection.");
}

function finishpost() {
    document.getElementById('addpost').style.display = 'none';

}

function addpost() {
    cat_id = document.getElementById('add_subcat').value;
    txt = document.getElementById('addmortxt').value;
    req_type = document.getElementById('addreq_type').value;
    city_id = document.getElementById('addcity').value;
    if (txt == "") {
        alert("please insert your description...");
        return;
    }
    $.post("add_post.php",
        {
            cat_id: cat_id,
            txt: txt,
            req_type: req_type,
            city_id: city_id
        },
        function (data, status) {
            myobj = JSON.parse(data);
            addedpostid = myobj.type;
            showform2(cat_id);
            document.getElementById('postform1').style.display = "none";
            document.getElementById('postform2').style.display = "";
            //alert(myobj.pm);
        });
}

function addselidinfo(id) {
    document.getElementById('adminselectid').value = id;
}

var formsel = [];
var importantform = [];
var formcaption = [];

function showform2(cat_id) {
    $.post("cat_form.php",
        {
            cat_id: cat_id,
        },
        function (data, status) {
            myobj = JSON.parse(data);
            res = "";
            for (i = 0; i < myobj.items.length; i++) {
                if (myobj.items[i].type == "select") {
                    params = "";
                    for (j = 0; j < myobj.items[i].vals.length; j++) {
                        params += "<option value='" + myobj.items[i].vals[j].optid + "'>" + myobj.items[i].vals[j].opttitle + "</option>";
                    }
                    res += "<label class='w3-text-blue' onclick='addselidinfo(" + myobj.items[i].id + ")'>" + myobj.items[i].title + "</label><select class='w3-select w3-border' id='addselval" + myobj.items[i].id + "'>" + params + "</select>";
                    formsel.push('addselval' + myobj.items[i].id);
                    importantform.push(0);
                    formcaption.push(myobj.items[i].title);
                }
                if (myobj.items[i].type == "numeric") {
                    var important = myobj.items[i].important;
                    var objectsss = "";
                    if (important == "1") {
                        objectsss = "required";
                    }
                    res += "<label class='w3-text-blue'>" + myobj.items[i].title + "</label><input class='w3-input w3-border' type='number' id='addnumericval" + myobj.items[i].id + "' " + objectsss + ">";
                    formsel.push('addnumericval' + myobj.items[i].id);
                    importantform.push(myobj.items[i].important);
                    formcaption.push(myobj.items[i].title);
                }
                if (myobj.items[i].type == "string") {
                    var important = myobj.items[i].important;
                    var objectsss = "";
                    if (important == "1") {
                        objectsss = "required";
                    }
                    if (myobj.items[i].bigtext == 0) {
                        res += "<label class='w3-text-blue'>" + myobj.items[i].title + "</label><input class='w3-input w3-border' type='text' id='addstringval" + myobj.items[i].id + "' " + objectsss + ">";
                    }
                    else {
                        res += "<label class='w3-text-blue'>" + myobj.items[i].title + "</label><textarea class='w3-input w3-border' id='addstringval" + myobj.items[i].id + "' " + objectsss + "></textarea>";
                    }
                    formsel.push('addstringval' + myobj.items[i].id);
                    importantform.push(myobj.items[i].important);
                    formcaption.push(myobj.items[i].title);
                }
            }
            res += "<input type='button' value='next' class='w3-btn w3-green w3-hover-blue' onclick='showform3(cat_id)'>";
            document.getElementById('postform2content').innerHTML = res;
        });
}

var snddata = {};

function showform3(cat_id) {
    var errnumber = 0;
    for (i = 0; i < formsel.length; i++) {
        snddata[formsel[i]] = document.getElementById(formsel[i]).value;
        if (importantform[i] == "1") {
            var meghdar = document.getElementById(formsel[i]).value;
            meghdar = meghdar.trim();
            if (meghdar == "") {
                errnumber++;
                var onvan = formcaption[i];
                alert("please insert " + onvan + "; this fild is Necessary...");
                break;
            }
        }
    }
    if (errnumber == 0) {
        $.ajax({
            url: "addform2.php?cat_id=" + cat_id + "&id=" + addedpostid,
            data: snddata,
            type: 'post',
            success: function (data) {
                //alert(data);
                document.getElementById('postform2').style.display = 'none';
                document.getElementById('postform3').style.display = '';
            }
        });
    }
}