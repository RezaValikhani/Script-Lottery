<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

function CreateUser($Name, $Phone, $IdLottery, $Date, $Code)
{
    $name = SaniTize($Name);
    $phone = SaniTize($Phone);
    $idlottery = SaniTize($IdLottery);
    $date = SaniTize($Date);
    $code = SaniTize($Code);
    global $connect, $tbl_info;
    $sql = ("INSERT `$tbl_info` SET `name`=?,`phone`=?,`idlottery`=?,`date`=?,`code`=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, $name);
    $result->bindValue(2, $phone);
    $result->bindValue(3, $idlottery);
    $result->bindValue(4, $date);
    $result->bindValue(5, $code);
    $result->execute();
    return $result;
}

function FindUsers()
{
    global $connect, $tbl_info;
    $sql = ("SELECT * FROM `$tbl_info` ORDER BY `id` DESC");
    $result = $connect->query($sql);
    $result->execute();
    if ($result->rowCount() >= 1) {
        return $result;
    }
return false;
}

function FindUserPaying()
{
    global $connect, $tbl_info;
    $sql = ("SELECT * FROM `$tbl_info` WHERE `statuspay`=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, '1');
    $result->execute();
    if ($result->rowCount() >= 1) {
        return $result;
    }
    return false;
}

function FindUserByPhone($Phone)
{
    $phone = SaniTize($Phone);
    global $connect, $tbl_info;
    $sql = ("SELECT * FROM `$tbl_info` WHERE `phone`=? LIMIT 1");
    $result = $connect->prepare($sql);
    $result->bindValue(1, $phone);
    $result->execute();
    if ($result->rowCount() >= 1) {
        return $result;
    }
    return false;
}

function isUserExist($Phone)
{
    global $connect, $tbl_info;
    $sql = ("SELECT `phone` FROM `$tbl_info` WHERE `licens`=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, $Licens);
    $result->execute();
    if ($result->rowCount() >= 1) {
        return $result;
    }
    return false;
}

function DeleteUser($id)
{
    global $connect, $tbl_info;
    $sql = ("DELETE FROM `$tbl_info` WHERE `id`=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, $id);
    $result->execute();
    if ($result->rowCount() == 1) {
        return $result;
    }
    return false;
}

function UpdateStatusPayPay($phone)
{
    global $connect, $tbl_info;
    $sql = ("UPDATE `$tbl_info` SET  `statuspay`=? WHERE phone=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, '1');
    $result->bindValue(2, $phone);
    $result->execute();
    return $result;
}

function UpdateStatusPay($id)
{
    global $connect, $tbl_info;
    $sql = ("UPDATE `$tbl_info` SET  `statuspay`=? WHERE id=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, '1');
    $result->bindValue(2, $id);
    $result->execute();
    return $result;
}

function UpdateStatusPayTo0($id) 
{
    global $connect, $tbl_info;
    $sql = ("UPDATE `$tbl_info` SET  `statuspay`=? WHERE id=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, '0');
    $result->bindValue(2, $id);
    $result->execute();
    return $result;
}

function ResetStatusWin() 
{
    global $connect, $tbl_info;
    $sql = ("UPDATE `$tbl_info` SET  `statuswin`=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, '0');
    $result->execute();
    return $result;
}

function ResetLottery() 
{
    global $connect, $tbl_info;
    $sql = ("UPDATE `$tbl_info` SET  `statuspay`=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, '0');
    $result->execute();
    return $result;
}

function CreateWinner($Name, $Phone, $Date, $IdLottery, $Hash)
{
    $name = SaniTize($Name);
    $phone = SaniTize($Phone);
    $date = SaniTize($Date);
    $idlottery = SaniTize($IdLottery);
    $hash = SaniTize($Hash);
    global $connect, $tbl_winner;
    $sql = ("INSERT `$tbl_winner` SET `name`=?,`phone`=?,`date`=?,`idlottery`=?,`hash`=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, $name);
    $result->bindValue(2, $phone);
    $result->bindValue(3, $date);
    $result->bindValue(4, $idlottery);
    $result->bindValue(5, $hash);
    $result->execute();
    return $result;
}

function FindWinner()
{
    global $connect, $tbl_winner;
    $sql = ("SELECT * FROM `$tbl_winner` ORDER BY `id` DESC");
    $result = $connect->prepare($sql);
    $result->execute();
    if ($result->rowCount() >= 1) {
        return $result;
    }
    return false;
}

function UpdateStatusWin($id)
{
    global $connect, $tbl_info;
    $sql = ("UPDATE `$tbl_info` SET  `statuswin`=? WHERE id=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, '1');
    $result->bindValue(2, $id);
    $result->execute();
    return $result;
}

function FindWinnerUp()
{
    global $connect, $tbl_info;
    $sql = ("SELECT `statuswin` FROM `$tbl_info` WHERE `statuswin`=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, '1');
    $result->execute();
    if ($result->rowCount() >= 1) {
        return $result;
    }
    return false;
}

function DeleteWinner($id)
{
    global $connect, $tbl_winner;
    $sql = ("DELETE FROM `$tbl_winner` WHERE `id`=?");
    $result = $connect->prepare($sql);
    $result->bindValue(1, $id);
    $result->execute();
    if ($result->rowCount() == 1) {
        return $result;
    }
    return false;
}