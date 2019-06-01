<?php
$dbuser = "root";
$dbpass = "";
$dbhost = "127.0.0.1";
$dbname = "socialdb";
$webtitle = "my social network";
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
function respm($type, $pm)
{
    ?>{"type":"<?php echo($type); ?>","pm":"<?php echo($pm); ?>"}<?php
}

function sqlstr($out)
{
    if (is_array($out) == true) {
        die();
    }
    $out = str_replace("'", "&#" . ord("'") . ";", $out);
    $out = str_replace('"', "&#" . ord('"') . ";", $out);
    $out = str_replace("&", "&#" . ord("&") . ";", $out);
    $out = str_replace("%", "&#" . ord("%") . ";", $out);
    $out = str_replace("(", "&#" . ord("(") . ";", $out);
    $out = str_replace(")", "&#" . ord(")") . ";", $out);
    //$out = str_replace("_", "&#" . ord("_") . ";", $out);
    $out = str_replace('\\', "&#" . ord("\\") . ";", $out);
    $out = str_replace('|', "&#" . ord("|") . ";", $out);
    $out = str_replace('<', "&#" . ord("<") . ";", $out);
    $out = str_replace('>', "&#" . ord(">") . ";", $out);
    return $out;
}

function sqlint($out)
{
    if (is_array($out) == true) {
        die();
    }
    if ($out != null || $out != "") {
        if (is_numeric($out) == false) {
            die();
        } else {
            return $out;
        }
    }
}

?>