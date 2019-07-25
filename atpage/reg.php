<div style="width: 100%; display: none;" id="regform" class="w3-animate-left">
    <div style="text-align: center; width: 80%; margin-left: 10%;" class="w3-panel w3-card-4 w3-white">
        <div id="login" style="text-align: center; width: 90%; margin-left: 5%;">
            <br>
            <form>
                <input type="text" name="user" id="ruser" placeholder="<?php echo($di_your_username); ?>"
                       class="w3-input w3-border"><br>
                <input type="password" name="pass" id="rpass" placeholder="<?php echo($di_your_password); ?>"
                       class="w3-input w3-border"><br>
                <input type="password" name="pass2" id="rpass2" placeholder="<?php echo($di_yourpassword_again); ?>"
                       class="w3-input w3-border"><br>
                <input type="email" name="email" id="remail" placeholder="<?php echo($di_your_email); ?>"
                       class="w3-input w3-border"><br>
                <input type="text" name="mobile" id="rmobile" placeholder="<?php echo($di_your_mobile_number); ?>"
                       class="w3-input w3-border"><br>
                <input type="text" name="name" id="rname" placeholder="<?php echo($di_your_name); ?>"
                       class="w3-input w3-border"><br>
                <input type="text" name="family" id="rfamily" placeholder="<?php echo($di_your_family); ?>"
                       class="w3-input w3-border"><br>
                <select class="w3-select w3-border" name="city" id="rcity">
                    <option value=""><?php echo($di_select_your_city); ?></option>
                    <?php
                    $sql = "select * from `city` order by `city_ord` DESC ";
                    $res = mysqli_query($connect, $sql);
                    while ($fild = mysqli_fetch_assoc($res)) {
                        ?>
                        <option value="<?php echo($fild['id']); ?>"><?php echo($fild['title']); ?></option>
                        <?php
                    }
                    ?>
                </select><br><br>
                <!--<input type="text" name="city" id="rcity" placeholder="your city" class="w3-input w3-border"><br>-->
                <input type="button" id="regbtn" value="<?php echo($di_signup); ?>" class="w3-btn w3-blue"
                       onclick="reguser();"
                       style="width: 90%;">
            </form>
        </div>
    </div>
    <div style="text-align: center; width: 70%; margin-left: 15%;" class="w3-white">
        <?php echo($di_have_an_acount); ?> <span style="color: #2196F3;"
                                                 onclick="showlogin()"><?php echo($di_login); ?></span>
    </div>
</div>