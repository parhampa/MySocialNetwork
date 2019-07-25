<div id="addcitym" class="w3-modal">
            <span class="w3-button w3-red w3-hover-red w3-xlarge w3-display-topright"
                  onclick="document.getElementById('addcitym').style.display='none'">&times;</span>
    <div class="w3-modal-content w3-animate-zoom" style="padding: 10px;">
        <input type="text" id="addcityname" class="w3-input w3-border" placeholder="<?php echo($di_city_name); ?>">
        <br>
        <input type="text" id="addcityorder" class="w3-input w3-border" placeholder="<?php echo($di_city_order); ?>">
        <br>
        <input onclick="addcityf()" type="button" style="border-radius: 5px; width: 100%;"
               class="w3-btn w3-green w3-hover-blue" value="<?php echo($di_add_city); ?>">
    </div>
</div>