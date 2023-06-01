<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

include "init.php";

if($_SESSION["LoginAdmin"] !== 'aqswdefrgt1t5yh13ujscsu9ssfvsrscsgwyrerwe')
{
    header("location:login.php");
    exit;
}

$Token = "___".sha1(rand(1111111111,999999999))."___";
$_SESSION["Token"] = $Token;

$sal = jdate('Y');
$mah = jdate('F');
$rooz = jdate('j');
$saat = jdate('H');
$dagigeh = jdate('i');
$sanyeh = jdate('s');
$Date = $rooz." ".$mah." ".$sal . " | " .$sanyeh." : ".$dagigeh." : ".$saat;

if(isset($_COOKIE["GetStartLottery"]))
{
$FindUserPaying = null;
$FindUserPaying = FindUserPaying();
if ($FindUserPaying) {
$rows = $FindUserPaying->fetchAll(PDO::FETCH_ASSOC);
shuffle($rows);
}
else
{
}
}

$hash = md5(time().$rows['8']['idlottery']);

?>
<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link href="assets/images/fuu.svg" rel="icon" type="image/png">
    <!-- Title -->
    <title> قرعه کشی توسط ادمین </title>
    <link rel="stylesheet" type="text/css" href="assets/css/farsi-font.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/mmd.css">

</head>
<body>
<div class="m"></div>
    <div class="form-body without-side">
	<!--
        <div class="website-logo">
            <a href="index-2.html">
                <div class="logo">
                    <img class="logo-size" src="" alt="">
                </div>
            </a>
        </div>
	-->
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="assets/images/graphic3.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>
                            خوش آمدید !
                        </h3>
                        
                        <p class="text-success">
                            برای انجام قرعه کشی روی دکمه شروع کلیک کنید !
                        </p>
						  
						  
						  <?php
						  if(isset($_COOKIE["okpaypart2"])) :
						  ?>
						  <div class="alert" style="background: green; opacity:0.8;">
						  <p>
						  <?php echo $_COOKIE["okpaypart2"]; ?>
						  </p>
						  </div>
						  <?php
						  endif;
						  ?>
						  
                        <form id="mamad" action="check.php" method="post">
                            <input id="name" class="form-control" type="text" name="name" maxlength="22" autocomplete="off" placeholder="- - -" value="- - -" readonly="readonly">
                            <input id="phone" class="form-control" type="text" name="phone" placeholder="- - -" maxlength="11" autocomplete="off" value="- - -" 
						  readonly="readonly">
						  
						  <input id="idlottery" class="form-control" type="text" name="idlottery" autocomplete="off" placeholder="- - -" value="- - -" readonly="readonly">
						  
                            <div class="form-button">
                                <button id="BtnGetSms" style="display: none;margin-bottom: 10px;" type="submit" name="BtnGetSms" class="ibtn"> درحال ارسال پیام به برنده ... </button>
                            
                            <button id="BtnSubmit" type="submit" name="BtnGetLottery" class="ibtn">انجام قرعه کشی </button>
                            </div>
                        </form>
                        <div class="other-links">
                            <div class="text"> ما را دنبال کنید در </div>
                            <a href="https://t.me/<?php echo $idtel; ?>"><i class="fab fa-telegram bg-info"></i> تلگرام </a>
							<a href="https://instagram.com/<?php echo $idinsta; ?>"><i class="fab fa-instagram bg-danger"></i>اینستاگرام</a>
                        </div>
                        <div class="page-links">
						ساخته شده توسط
                            <a href="https://sourcesaaz.ir/"> تیم سورس ساز  &copy </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
<?php
if(isset($_COOKIE["GetStartLottery"])):
?>
    setTimeout(function()
    {
    document.getElementById("BtnSubmit").disabled = true;
    document.getElementById("BtnSubmit").innerHTML = "درحال پردازش ...";
    document.getElementById("BtnSubmit").style.background = "green";
    document.getElementById("name").value = "<?php echo $rows['0']['name']; ?>";
    document.getElementById("phone").value = "<?php echo PhoneSunSor($rows['0']['phone']); ?>";
    document.getElementById("idlottery").value = "<?php echo $rows['0']['idlottery']; ?>";
    },1000);
    
    setTimeout(function()
    {
    document.getElementById("name").value = "<?php echo $rows['1']['name']; ?>";
    document.getElementById("phone").value = "<?php echo PhoneSunSor($rows['1']['phone']); ?>";
    document.getElementById("idlottery").value = "<?php echo $rows['1']['idlottery']; ?>";
    },2000);
    
    setTimeout(function()
    {
    document.getElementById("name").value = "<?php echo $rows['2']['name']; ?>";
    document.getElementById("phone").value = "<?php echo PhoneSunSor($rows['2']['phone']); ?>";
    document.getElementById("idlottery").value = "<?php echo $rows['2']['idlottery']; ?>";
    },3000);
    
    setTimeout(function()
    {
    document.getElementById("name").value = "<?php echo $rows['3']['name']; ?>";
    document.getElementById("phone").value = "<?php echo PhoneSunSor($rows['3']['phone']); ?>";
    document.getElementById("idlottery").value = "<?php echo $rows['3']['idlottery']; ?>";
    },4000);
    
    setTimeout(function()
    {
    document.getElementById("name").value = "<?php echo $rows['4']['name']; ?>";
    document.getElementById("phone").value = "<?php echo PhoneSunSor($rows['4']['phone']); ?>";
    document.getElementById("idlottery").value = "<?php echo $rows['4']['idlottery']; ?>";
    },5000);
    
    setTimeout(function()
    {
    document.getElementById("name").value = "<?php echo $rows['5']['name']; ?>";
    document.getElementById("phone").value = "<?php echo PhoneSunSor($rows['5']['phone']); ?>";
    document.getElementById("idlottery").value = "<?php echo $rows['5']['idlottery']; ?>";
    },6000);
    
    setTimeout(function()
    {
    document.getElementById("name").value = "<?php echo $rows['6']['name']; ?>";
    document.getElementById("phone").value = "<?php echo PhoneSunSor($rows['6']['phone']); ?>";
    document.getElementById("idlottery").value = "<?php echo $rows['6']['idlottery']; ?>";
    },7000);
    
    setTimeout(function()
    {
    document.getElementById("name").value = "<?php echo $rows['7']['name']; ?>";
    document.getElementById("phone").value = "<?php echo PhoneSunSor($rows['7']['phone']); ?>";
    document.getElementById("idlottery").value = "<?php echo $rows['7']['idlottery']; ?>";
    },8000);
    
    setTimeout(function()
    {
    document.getElementById("name").value = "<?php echo $rows['8']['name']; ?>";
    document.getElementById("phone").value = "<?php echo PhoneSunSor($rows['8']['phone']); ?>";
    document.getElementById("idlottery").value = "<?php echo $rows['8']['idlottery']; ?>";
    document.getElementById("BtnSubmit").disabled = false;
    document.getElementById("BtnSubmit").innerHTML = "قرعه کشی مجدد";
    document.getElementById("BtnSubmit").style.background = "blue";
    document.getElementById("BtnGetSms").style.display = "block";
    <?php
    UpdateStatusPayTo0($rows['8']['id']);
    CreateWinner($rows['8']['name'], $rows['8']['phone'], $Date, $rows['8']['name'],$hash);
    UpdateStatusWin($rows['8']['id']);
    $name = $rows['8']['name'];
    $idlottery = $rows['8']['idlottery'];
    $Message = "سلام $name عزیز
شما در قرعه کشی $lotteryname برنده شده اید ☘️
کد قرعه کشی شما : $idlottery

برای دریافت جایزه خود به پشتیبان پیام دهید 
$Domain";
    SendPm($Message ,$rows['8']['phone'] ,$SmsUser ,$SmsPass ,$SmsFrom);
    ?>
    },9000);
    
    setTimeout(function()
    {
    document.getElementById("BtnGetSms").style.background = "green";
    document.getElementById("BtnGetSms").disabled = true;
    document.getElementById("BtnGetSms").innerHTML = "ارسال شد !";
    },10000);
<?php
endif;
?>
</script>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
