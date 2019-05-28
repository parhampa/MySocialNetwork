<?php
session_start();
$loginstatus = "";
if (isset($_SESSION['user']) == false) {
    $loginstatus = "w3-disabled";
}
$admin = false;
if (isset($_SESSION['user']) == true) {
    if ($_SESSION['user'] == 'admin') {
        $admin = true;
    }
}
include("config.php");
?>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/w3.css">
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style>
        div.scrollmenu {
            height: 60px !important;
            overflow: auto;
            white-space: nowrap;
        }

        div.scrollmenu span {
            display: inline-block;
            text-decoration: none;
        }
    </style>

</head>
<body class="backload">
<div style="width: 80%; margin-left: 10%;" class="w3-white w3-panel w3-card-2" id="mainpart">
    <span style="font-size: 12px;" class="w3-text-blue">messages <span class="w3-text-red" style="width: 15px;">5</span></span>
    <div style="height: 40px; width: 100%; margin-top: 10px; margin-bottom: 10px;" class="scrollmenu">
        <span class="w3-btn w3-blue w3-hover-pink <?php echo($loginstatus); ?>"
              onclick="addanewpost()" style="border-radius: 25px;">add a new post</span>
        <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;">category</span>
        <?php
        if ($loginstatus != "") {
            ?>
            <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
                  onclick="location.replace('index.php')">login</span>
            <?php
        } else {
            ?>
            <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
                  onclick="location.replace('logout.php')">logout</span>
            <?php
        }
        if ($admin == true) {
            ?>
            <script>
                function showaddcat() {
                    document.getElementById('addcat').style.display = 'block';
                    document.getElementById('addcatplc').style.display = "";
                    document.getElementById('addselcatplc').style.display = "none";
                    document.getElementById('addnumericplc').style.display = "none";
                    document.getElementById('addstringplc').style.display = "none";
                }
            </script>
            <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
                  onclick="showaddcat()">add category</span>
            <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
                  onclick="document.getElementById('addcitym').style.display='block'">add city</span>
            <?php
        }
        ?>
    </div>
    <?php
    if ($admin == true) {
        ?>
        <div id="addcitym" class="w3-modal">
            <span class="w3-button w3-red w3-hover-red w3-xlarge w3-display-topright"
                  onclick="document.getElementById('addcitym').style.display='none'">&times;</span>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px;">
                <script>
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
                </script>
                <input type="text" id="addcityname" class="w3-input w3-border" placeholder="city name">
                <br>
                <input type="text" id="addcityorder" class="w3-input w3-border" placeholder="city order">
                <br>
                <input onclick="addcityf()" type="button" style="border-radius: 5px; width: 100%;"
                       class="w3-btn w3-green w3-hover-blue" value="add city">
            </div>
        </div>

        <div id="addcat" class="w3-modal">
            <span class="w3-button w3-red w3-hover-red w3-xlarge w3-display-topright"
                  onclick="document.getElementById('addcat').style.display='none'">&times;</span>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px;" id="addcatplc">
                <form>
                    <input type="text" class="w3-input w3-border" id="cat_ord"
                           placeholder="your category order: for example 10"><br>
                    <select id="father" class="w3-input w3-border">
                        <option value="0">your category father</option>
                        <?php
                        $sql = "select * from cat where `father`=0 order by `cat_ord` DESC";
                        $res = mysqli_query($connect, $sql);
                        while ($fild = mysqli_fetch_assoc($res)) {
                            ?>
                            <option value="<?php echo($fild['id']); ?>"><?php echo($fild['title']); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br>
                    <input type="text" class="w3-input w3-border" id="title"
                           placeholder="your category title: for example sport news"><br>
                    <span class="w3-btn w3-blue" onclick="addcat()">add category</span>
                    <span class="w3-btn w3-blue" id="editcat" style="display:none;"
                          onclick="editcat()">edit category</span>
                    <span class="w3-btn w3-blue" id="deletecat" style="display:none;" onclick="deletecat()">delete category</span>
                    <br>
                    <br>
                    <span class="w3-btn w3-blue" id="addselitem" style="display: none;"
                          onclick="showaddselcatpg()">add select item</span>
                    <span class="w3-btn w3-blue" id="addnumericitem" style="display: none;"
                          onclick="showaddnumericplc()">add numeric item</span>
                    <span class="w3-btn w3-blue" id="addstringitem" style="display: none;"
                          onclick="showstringplc()">add string item</span>

                </form>
                <div id="catplc">
                    <?php
                    $sql = "select * from cat where `father`=0 ORDER BY `cat_ord` DESC ";
                    $res = mysqli_query($connect, $sql);
                    while ($fild = mysqli_fetch_assoc($res)) {
                        ?>
                        <br><br><span class="w3-btn w3-pink w3-round-xxlarge"
                                      onclick="docat(<?php echo($fild['id']); ?>,'<?php echo($fild['title']); ?>','<?php echo($fild['father']); ?>',<?php echo($fild['cat_ord']); ?>)"><?php echo($fild['title']); ?></span>
                        <br><br>
                        <?php
                        $father = $fild['id'];
                        $sql2 = "select * from cat where `father`=$father order by `cat_ord` DESC ";
                        $res2 = mysqli_query($connect, $sql2);
                        while ($fild2 = mysqli_fetch_assoc($res2)) {
                            ?>
                            <span class="w3-btn w3-green w3-round-xxlarge"
                                  onclick="docat(<?php echo($fild2['id']); ?>,'<?php echo($fild2['title']); ?>','<?php echo($fild2['father']); ?>',<?php echo($fild2['cat_ord']); ?>)"><?php echo($fild2['title']); ?></span>
                            <?php
                        }
                    }
                    ?>
                </div>
                <script>
                    var pubcatid = 0;

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
                </script>
            </div>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="addselcatplc">
                <script>
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
                </script>
                <form>
                    <input type="text" class="w3-input w3-border" id="addselcat_id" placeholder="your category id"
                           disabled>
                    <input type="text" class="w3-input w3-border" id="addseltitle" placeholder="your selectbox title">
                    <input type="text" class="w3-input w3-border" id="addsel_order" placeholder="your selectbox order">
                    <input type="button" class="w3-btn w3-green w3-hover-blue" onclick="addselectitem()"
                           value="add select box">
                    <input type="button" class="w3-btn w3-blue" value="back" onclick="showaddcat();">
                </form>
            </div>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="addnumericplc">
                <input type="text" class="w3-input w3-border" placeholder="your numeric category id" id="numericcatid"
                       disabled>
                <input type="text" class="w3-input w3-border" placeholder="your numeric title" id="numerictitle">
                <input type="text" class="w3-input w3-border" placeholder="your numeric order" id="numericorderval">
                <label class="w3-text-blue">Forced entry:</label>
                <select id="numericimportant" class="w3-select w3-border">
                    <option value="0">no</option>
                    <option value="1">yes</option>
                </select>
                <label class="w3-text-blue">Is it money ?</label>
                <select id="numericmoney" class="w3-select w3-border">
                    <option value="0">no</option>
                    <option value="1">yes</option>
                </select>
                <br>
                <br>
                <input type="text" class="w3-btn w3-green w3-hover-blue" value="add numeric item"
                       onclick="addnumericitem()">
                <input type="text" class="w3-btn w3-blue" onclick="showaddcat()" value="back">
            </div>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="addstringplc">
                <script>
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
                </script>
                <input type="text" class="w3-input w3-border" placeholder="your category id" id="addstringcatid"
                       disabled>
                <input type="text" class="w3-input w3-border" placeholder="your string title" id="addstringtitle">
                <input type="text" class="w3-input w3-border" placeholder="your string order" id="addstringorder">
                <label class="w3-text-blue">Forced entry:</label>
                <select id="stringimportant" class="w3-select w3-border">
                    <option value="0">no</option>
                    <option value="1">yes</option>
                </select>
                <label class="w3-text-blue">Is it textarea?</label>
                <select id="stringtextarea" class="w3-select w3-border">
                    <option value="0">no</option>
                    <option value="1">yes</option>
                </select>
                <br>
                <br>
                <input type="button" class="w3-btn w3-green w3-hover-blue" value="add string item"
                       onclick="addstringitem()">
                <input type="button" class="w3-btn w3-blue" value="back" onclick="showaddcat()">
            </div>
        </div>

        <script>
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
        </script>
        <?php
    }
    if (isset($_SESSION['user']) == true) {
        ?>
        <div id="addpost" class="w3-modal">
            <span class="w3-button w3-red w3-hover-red w3-xlarge w3-display-topright"
                  onclick="document.getElementById('addpost').style.display='none'">&times;</span>

            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px;" id="postform1">
                <script>
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
                </script>
                <select class="w3-select w3-border" id="add_fcat" onchange="loadsubcat();">
                    <option value="">select category</option>
                    <?php
                    $sql = "select * from `cat` where father=0 order by `cat_ord` DESC";
                    $res = mysqli_query($connect, $sql);
                    while ($fild = mysqli_fetch_assoc($res)) {
                        ?>
                        <option value="<?php echo($fild['id']); ?>"><?php echo($fild['title']); ?></option>
                        <?php
                    }
                    ?>
                </select>
                <br>
                <br>
                <div id="subcatplace"></div>
                <br><br>
                <script>
                    function loadmorinfo() {
                        if (document.getElementById('add_subcat').value != 0) {
                            document.getElementById('morinfo').style.display = "";
                        }
                        else {
                            document.getElementById('morinfo').style.display = "none";
                        }
                    }
                </script>
                <div id="morinfo" style="display: none;">
                    <textarea style="width: 100%;" rows="5" maxlength="300"
                              id="addmortxt" placeholder="your more information"></textarea>
                    <br>
                    <br>
                    <select class="w3-select w3-border" id="addreq_type">
                        <option value="0">Provider</option>
                        <option value="1">Applicant</option>
                    </select>
                    <br>
                    <br>
                    <select class="w3-select w3-border" id="addcity">
                        <?php
                        $sql = "select * from `city` order by `city_ord` DESC ";
                        $res = mysqli_query($connect, $sql);
                        while ($fild = mysqli_fetch_assoc($res)) {
                            ?>
                            <option value="<?php echo($fild['id']); ?>"><?php echo($fild['title']); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br>
                    <input onclick="addpost()" type="button" style="border-radius: 5px; width: 100%;"
                           class="w3-btn w3-green w3-hover-blue" value="next">
                </div>
            </div>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="postform2">
                <?php
                if ($_SESSION['user'] == "admin") {
                    ?>
                    <script>
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
                    </script>
                    <input type="text" placeholder="your select id" value="" id="adminselectid"><br>
                    <input type="text" placeholder="your addition title" value="" id="adminadditiontitle"><br>
                    <input type="button" value="add option" onclick="addselectitemfunc()">
                    <?php
                }
                ?>
                <div style="width: 100%;" id="postform2content">

                </div>

            </div>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="postform3">
                <div style="min-height: 160px; width: 100%; border-style: dashed; border-radius: 5px; background-color: darkgray;">

                </div>
                <br>
                <div class="row">
                    <script>
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
                    </script>
                    <label for="fileToUpload">Select a File to Upload</label><br/>
                    <input type="file" name="fileToUpload[]" id="fileToUpload" onchange="fileSelected();"
                           accept="image/*" multiple/>
                    <input type="button" class="w3-btn w3-green w3-hover-blue" value="upload picture"
                           onclick="uploadFile(0)">
                    <div class="w3-light-grey w3-round">
                        <div class="w3-container w3-blue w3-round" style="width:0%" id="progressbar">0%</div>
                    </div>
                    <br>
                    <input type="button" class="w3-btn w3-blue w3-hover-red" value="finish" onclick="finishpost();">
                    <div id="progressNumber"></div>

                </div>
            </div>
        </div>
        <script>
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
        </script>
    <?php
    if ($admin == true)
    {
    ?>
        <div style="width: 100%;">
            <span class="w3-btn w3-green" onclick="location.replace('main.php')">show all post</span>
            <span class="w3-btn w3-green" onclick="location.replace('main.php?vi=1')">show visible post</span>
            <span class="w3-btn w3-green" onclick="location.replace('main.php?vi=0')">show unvisible post</span>
        </div>
        <?php
    }
    }
    $filter = "";
    if (isset($_GET['vi']) == true && $admin == true) {
        $vi = sqlint($_GET['vi']);
        if ($vi != 0 && $vi != 1) {
            die();
        }
        if ($filter == "") {
            $filter = " where `visible`=$vi";
        } else {
            $filter = "`visible`=$vi";
        }
    }
    $sqlpost = "";
    if ($admin == true) {
        $sqlpost = "select * from `post` $filter order by `id` DESC limit 0,15";
    } else {
        $sqlpost = "select * from `post` where `visible`=1 order by `post_order` DESC limit 0,15";
    }
    $res = mysqli_query($connect, $sqlpost);
    while ($fild = mysqli_fetch_assoc($res)) {
        ?>
        <div style="width: 100%; padding: 10px;" class="postmain">
            <div style="width: 70%; margin-left: 15%; padding: 10px;" class="w3-card-2 postcontent">
                <div>
                    <div style=" margin-right:10px; float: left ; border-radius: 50%; background-color: black; height: 50px; width: 50px;"></div>
                    <div><span style="font-size: 6px;"><br></span><?php echo($fild['user']); ?></div>
                    <hr>
                </div>
                <div>
                    <div>
                        <?php
                        $post_id = $fild['id'];
                        $sqlpic = "select * from `post_pics` where `post_id`=$post_id";
                        $respic = mysqli_query($connect, $sqlpic);
                        $picaddress = "pic/no_pic.jpg";
                        if (mysqli_num_rows($respic) == 0) {
                            ?>
                            <img src="<?php echo($picaddress); ?>" style="width: 100%;"><br>
                            <?php
                        }
                        $piccount = 0;
                        while ($fildpic = mysqli_fetch_assoc($respic)) {
                            $displaypic = "";
                            if ($piccount > 0) {
                                $displaypic = " display:none;";
                            }
                            if (file_exists($fildpic['address']) == true) {
                                $picaddress = $fildpic['address'];
                            }
                            ?>
                            <img src="<?php echo($picaddress); ?>"
                                 style="width: 100%;<?php echo($displaypic); ?>"
                                 class="imagepost<?php echo($post_id); ?> imagepostnumber<?php echo($post_id . '-' . $piccount); ?>">
                            <?php
                            $piccount++;
                        }
                        ?>
                        <div id="slidebtn" style="margin-top:5px; width: 100%;">
                            <?php
                            for ($i = 0; $i < mysqli_num_rows($respic); $i++) {
                                ?>
                                <span onclick="showslide(<?php echo($i); ?>,<?php echo($post_id); ?>)" class="w3-gray"
                                      style=" margin-right:10px; float: left ; border-radius: 50%; background-color: black; height: 10px; width: 10px;"></span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <br>
                    <span class="heart"></span>
                    <hr>
                    <p><?php echo($fild['txt']); ?></p>
                    <div style="display: none;" id="morpostid<?php echo($fild['id']); ?>"></div>
                    <div style="width: 100%; font-size: 12px; color: #979797;">
                        <span onclick="showmorepost(<?php echo($fild['id']); ?>)"
                              id="btnshmor<?php echo($fild['id']); ?>">more...</span>
                        <span style="display: none;" onclick="hidemorepost(<?php echo($fild['id']); ?>)"
                              id="btnhimor<?php echo($fild['id']); ?>">hide...</span>
                    </div>
                    <?php
                    if ($admin == true) {
                        if ($fild['visible'] == 0) {
                            ?>
                            <span class="w3-btn w3-green" onclick="visiblepost(<?php echo($fild['id']); ?>)"
                                  id="visiblepost<?php echo($fild['id']); ?>">make it visible</span>
                            <span class="w3-btn w3-green" onclick="unvisiblepost(<?php echo($fild['id']); ?>);"
                                  id="unvisiblepost<?php echo($fild['id']); ?>"
                                  style="display: none;">make it unvisible</span>
                            <?php
                        } else {
                            ?>
                            <span class="w3-btn w3-green" onclick="unvisiblepost(<?php echo($fild['id']); ?>);"
                                  id="unvisiblepost<?php echo($fild['id']); ?>">make it unvisible</span>
                            <span class="w3-btn w3-green" onclick="visiblepost(<?php echo($fild['id']); ?>)"
                                  id="visiblepost<?php echo($fild['id']); ?>"
                                  style="display: none;">make it visible</span>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <br>
        <?php
    }
    ?>
    <style>
        .heart {
            background-image: url("pic/heart.png");
            background-size: 100%;
            background-repeat: no-repeat;
            display: inline-block;
            position: relative;
            height: 30px;
            width: 30px;
            top: 10px;
        }
    </style>
</div>
<script>
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
        })
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
        })
    }

    function showmorepost(id) {
        $.ajax({
            url: "morepost.php?id=" + id,
            ids: id,
            type: 'get',
            success: function (data) {
                //alert(data);
                /*document.getElementById('postform2').style.display = 'none';
                document.getElementById('postform3').style.display = '';*/
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
        var id = "strid" + oldid;
        var paramval = document.getElementById(id).innerHTML;
        document.getElementById(id).onclick = "";
        document.getElementById(id).innerHTML = "<input style='width: 100%' type='text' id='t" + id + "' value='" + paramval + "'><input type='button' value='save' onclick='savetxt(" + oldid + "," + postid + ")'><input onclick='canseledotmortxt(" + oldid + "," + postid + ")' type='button' value='cancel'>";
    }

    function editmortxtarea(oldid, postid) {
        var id = "strid" + oldid;
        var paramval = document.getElementById(id).innerHTML;
        document.getElementById(id).onclick = "";
        document.getElementById(id).innerHTML = "<textarea style='width: 100%;' id='t" + id + "'>" + paramval + "</textarea><input type='button' value='save' onclick='savetxt(" + oldid + "," + postid + ")'><input onclick='canseledotmortxt(" + oldid + "," + postid + ")' type='button' value='cancel'>";
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
        var id = "numid" + oldid;
        var paramval = document.getElementById(id).innerHTML;
        document.getElementById(id).onclick = "";
        document.getElementById(id).innerHTML = "<input style='width: 100%' type='number' id='n" + id + "' value='" + paramval + "'><input type='button' value='save' onclick='savenumber(" + oldid + "," + postid + ")'><input onclick='canseledotmornumeric(" + oldid + "," + postid + ")' type='button' value='cancel'>";
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
</script>
</body>
</html>