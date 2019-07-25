<div style="width: 100%;" id="loginform" class="w3-animate-right">
    <div id="login" style="text-align: center; width: 60%; margin-left: 20%;">
        <div id="login" style="text-align: center; width: 90%; margin-left: 5%;" class="w3-panel w3-card-4 w3-white">
            <br>
            <form>
                <input type="text" name="username" id="lusername" placeholder="<?php echo($di_username); ?>"
                       class="w3-input w3-border"><br>
                <input type="password" name="password" id="lpassword" placeholder="<?php echo($di_password); ?>"
                       class="w3-input w3-border"><br>
                <input type="button" value="<?php echo($di_login); ?>" class="w3-btn w3-blue" style="width: 90%;"
                       onclick="ulogin()">
            </form>
        </div>
    </div>
    <div style="text-align: center; width: 70%; margin-left: 15%;" class="w3-white">
        <?php echo($di_have_account_question); ?> <span style="color: #2196F3;"
                                                        onclick="showreg()"><?php echo($di_signup); ?></span>
    </div>
</div>