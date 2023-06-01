<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

function FindAdminByEmail($email)
{
    global $connect, $tbl_admin;
    $sql = ("SELECT * FROM `$tbl_admin` WHERE `email`=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, $email);
    $result->execute();
    if ($result->rowCount() >= 1) {
        return $result;
    }
    return false;
}