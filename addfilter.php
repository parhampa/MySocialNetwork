<?php
function add_get_number_filter($getname, $admin, $filter, $fild)
{
    if (isset($_GET[$getname]) == true) {
        $scat = sqlint($_GET[$getname]);
        $scatf = "`$fild`=$scat";
        if ($admin == true) {
            if ($filter == "") {
                $filter = " where $scatf";
            } else {
                $filter = " and $scatf";
            }
        } else {
            $filter = " and $scatf";
        }
        return $filter;
    }
}

function add_cooki_number_filter($cookiname, $admin, $filter, $fild, $zironull)
{
    if (isset($_COOKIE[$cookiname]) == true) {
        if ($zironull == false || ($zironull == true && $_COOKIE[$cookiname] != 0)) {
            $scat = sqlint($_COOKIE[$cookiname]);
            $scatf = "`$fild`=$scat";
            if ($admin == 1) {
                if ($filter == "") {
                    $filter = " where $scatf";
                } else {
                    $filter .= " and $scatf";
                }
            } else {
                $filter .= " and $scatf";
            }
        }
    }
    return $filter;
}

?>