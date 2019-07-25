<div id="addcat" class="w3-modal">
            <span class="w3-button w3-red w3-hover-red w3-xlarge w3-display-topright"
                  onclick="document.getElementById('addcat').style.display='none'">&times;</span>
    <div class="w3-modal-content w3-animate-zoom" style="padding: 10px;" id="addcatplc">
        <form>
            <input type="text" class="w3-input w3-border" id="cat_ord"
                   placeholder="<?php echo($di_yourcat_order); ?>"><br>
            <select id="father" class="w3-input w3-border">
                <option value="0"><?php echo($di_yourcat_father); ?></option>
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
                   placeholder="<?php echo($di_yourcat_title); ?>"><br>
            <span class="w3-btn w3-blue" onclick="addcat()"><?php echo($di_add_cat); ?></span>
            <span class="w3-btn w3-blue" id="editcat" style="display:none;"
                  onclick="editcat()"><?php echo($di_edit_cat); ?></span>
            <span class="w3-btn w3-blue" id="deletecat" style="display:none;"
                  onclick="deletecat()"><?php echo($di_delete_cat); ?></span>
            <br>
            <br>
            <span class="w3-btn w3-blue" id="addselitem" style="display: none;"
                  onclick="showaddselcatpg()"><?php echo($di_add_select_item); ?></span>
            <span class="w3-btn w3-blue" id="addnumericitem" style="display: none;"
                  onclick="showaddnumericplc()"><?php echo($di_add_numeric_item); ?></span>
            <span class="w3-btn w3-blue" id="addstringitem" style="display: none;"
                  onclick="showstringplc()"><?php echo($di_add_string_item); ?></span>

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
    </div>
    <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="addselcatplc">
        <form>
            <input type="text" class="w3-input w3-border" id="addselcat_id"
                   placeholder="<?php echo($di_your_category_id); ?>"
                   disabled>
            <input type="text" class="w3-input w3-border" id="addseltitle"
                   placeholder="<?php echo($di_your_select_box_title); ?>">
            <input type="text" class="w3-input w3-border" id="addsel_order"
                   placeholder="<?php echo($di_your_select_box_order); ?>">
            <input type="button" class="w3-btn w3-green w3-hover-blue" onclick="addselectitem()"
                   value="<?php echo($di_add_select_box); ?>">
            <input type="button" class="w3-btn w3-blue" value="<?php echo($di_back); ?>" onclick="showaddcat();">
        </form>
    </div>
    <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="addnumericplc">
        <input type="text" class="w3-input w3-border" placeholder="<?php echo($di_your_numeric_category_id); ?>"
               id="numericcatid"
               disabled>
        <input type="text" class="w3-input w3-border" placeholder="<?php echo($di_your_numeric_title); ?>"
               id="numerictitle">
        <input type="text" class="w3-input w3-border" placeholder="<?php echo($di_your_numeric_item_order); ?>"
               id="numericorderval">
        <label class="w3-text-blue"><?php echo($di_forced_entry); ?></label>
        <select id="numericimportant" class="w3-select w3-border">
            <option value="0"><?php echo($di_no); ?></option>
            <option value="1"><?php echo($di_yes); ?></option>
        </select>
        <label class="w3-text-blue"><?php echo($di_is_money); ?></label>
        <select id="numericmoney" class="w3-select w3-border">
            <option value="0"><?php echo($di_no); ?></option>
            <option value="1"><?php echo($di_yes); ?></option>
        </select>
        <br>
        <br>
        <input type="text" class="w3-btn w3-green w3-hover-blue" value="<?php echo($di_add_numeric_item); ?>"
               onclick="addnumericitem()">
        <input type="text" class="w3-btn w3-blue" onclick="showaddcat()" value="<?php echo($di_back); ?>">
    </div>
    <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="addstringplc">
        <input type="text" class="w3-input w3-border" placeholder="<?php echo($di_your_category_id); ?>"
               id="addstringcatid"
               disabled>
        <input type="text" class="w3-input w3-border" placeholder="<?php echo($di_you_string_title); ?>"
               id="addstringtitle">
        <input type="text" class="w3-input w3-border" placeholder="<?php echo($di_your_string_order); ?>"
               id="addstringorder">
        <label class="w3-text-blue"><?php echo($di_forced_entry); ?></label>
        <select id="stringimportant" class="w3-select w3-border">
            <option value="0"><?php echo($di_no); ?></option>
            <option value="1"><?php echo($di_yes); ?></option>
        </select>
        <label class="w3-text-blue"><?php echo($di_is_it_textarea); ?></label>
        <select id="stringtextarea" class="w3-select w3-border">
            <option value="0"><?php echo($di_no); ?></option>
            <option value="1"><?php echo($di_yes); ?></option>
        </select>
        <br>
        <br>
        <input type="button" class="w3-btn w3-green w3-hover-blue" value="<?php echo($di_add_string_item); ?>"
               onclick="addstringitem()">
        <input type="button" class="w3-btn w3-blue" value="<?php echo($di_back); ?>" onclick="showaddcat()">
    </div>
</div>