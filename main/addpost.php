<div id="addpost" class="w3-modal">
            <span class="w3-button w3-red w3-hover-red w3-xlarge w3-display-topright"
                  onclick="document.getElementById('addpost').style.display='none'">&times;</span>

    <div class="w3-modal-content w3-animate-zoom" style="padding: 10px;" id="postform1">
        <select class="w3-select w3-border" id="add_fcat" onchange="loadsubcat();">
            <option value=""><?php echo($di_select_category); ?></option>
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
        <div id="morinfo" style="display: none;">
                    <textarea style="width: 100%;" rows="5" maxlength="300"
                              id="addmortxt" placeholder="<?php echo($di_your_more_info); ?>"></textarea>
            <br>
            <br>
            <select class="w3-select w3-border" id="addreq_type">
                <option value="0"><?php echo($di_Provider); ?></option>
                <option value="1"><?php echo($di_Applicant); ?></option>
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
                   class="w3-btn w3-green w3-hover-blue" value="<?php echo($di_next); ?>">
        </div>
    </div>
    <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="postform2">
        <?php
        if ($admin == true) {
            ?>
            <input type="text" placeholder="<?php echo($di_your_select_id); ?>" value="" id="adminselectid"><br>
            <input type="text" placeholder="<?php echo($di_your_additopntitle); ?>" value="" id="adminadditiontitle">
            <br>
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
            <label for="fileToUpload"><?php echo($di_select_file_to_upload); ?></label><br/>
            <input type="file" name="fileToUpload[]" id="fileToUpload" onchange="fileSelected();"
                   accept="image/*" multiple/>
            <input type="button" class="w3-btn w3-green w3-hover-blue" value="<?php echo($di_upload_picture); ?>"
                   onclick="uploadFile(0)">
            <div class="w3-light-grey w3-round">
                <div class="w3-container w3-blue w3-round" style="width:0%" id="progressbar">0%</div>
            </div>
            <br>
            <input type="button" class="w3-btn w3-blue w3-hover-red" value="<?php echo($di_finish); ?>"
                   onclick="finishpost();">
            <div id="progressNumber"></div>

        </div>
    </div>
</div>