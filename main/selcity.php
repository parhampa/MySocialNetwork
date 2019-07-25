<div>
        <span onclick="selcitym();">
            <i class="fas fa-map-marker-alt"></i> <span style="color: blue;">
                <?php
                $citycooki = 0;
                if (isset($_COOKIE['city']) == true) {
                    if ($_COOKIE['city'] != 0) {
                        $citycooki = sqlint($_COOKIE['city']);
                    }
                }
                if ($citycooki != 0) {
                    $sqlselcity = "select * from `city` where `id`=$citycooki";
                    $resselcity = mysqli_query($connect, $sqlselcity);
                    if (mysqli_num_rows($resselcity) > 0) {
                        $fildselcity = mysqli_fetch_assoc($resselcity);
                        echo($fildselcity['title']);
                    } else {
                        echo($di_all_cities);
                    }
                } else {
                    echo($di_all_cities);
                }
                ?>

            </span>
        </span>
    <br>
    <br>
    <div id="selcity" class="w3-modal">
            <span class="w3-button w3-red w3-hover-red w3-xlarge w3-display-topright"
                  onclick="document.getElementById('selcity').style.display='none'">&times;</span>
        <div class="w3-modal-content w3-animate-zoom" style="padding: 50px;">
            <?php
            $sqlselcity = "select * from `city` order by `city_ord` DESC";
            $resselcity = mysqli_query($connect, $sqlselcity);
            ?>
            <i class="fas fa-map-marker-alt"></i>
            <select class="w3-select w3-border" style="width: 40%;" id="selcityfilter">
                <option value="0"><?php echo($di_all_cities); ?></option>
                <?php
                while ($fildselcity = mysqli_fetch_assoc($resselcity)) {
                    ?>
                    <option value="<?php echo($fildselcity['id']); ?>"><?php echo($fildselcity['title']); ?></option>
                    <?php
                }
                ?>
            </select>
            <span class="w3-btn w3-green" onclick="showcitysel()"><?php echo($di_set_city); ?></span>
        </div>
    </div>
</div>