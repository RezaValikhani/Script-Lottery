<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

include "init.php";
$Token = "___".sha1(rand(1111111111,999999999))."___";
$_SESSION["Token"] = $Token;

?>
<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/farsi-font.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/mmd.css">
     <!-- Favicon -->
    <link href="assets/images/fuu.svg" rel="icon" type="image/png">
    <!-- Title -->
    <title> قرعه کشی <?php echo $lotteryname; ?> </title>
</head>
<body>
<div class="m"></div>
    <div class="form-body without-side">
	<!--
        <div class="website-logo">
            <a href="">
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
                        <?php
						  if(isset($_COOKIE["SingIning"])) 
						  {
						      echo '<h3> خوش آمدید ! </h3>';
						  }
						  else
						  {
						      echo '<h3>ثبت نام در قرعه کشی</h3>';
						  }
						?>
                        
                        <?php
						  if(isset($_COOKIE["SingIning"])) 
						  {
						      $FindUser = null;
                              $FindUser = FindUserByPhone($_COOKIE["SingIning"]);
                              if ($FindUser) {
                              $rows = $FindUser->fetchAll(PDO::FETCH_ASSOC);
                              foreach ($rows as $row) 
                              {
                                    $m = $row['statuspay'];
                                    $m2 = $row['statuswin'];
                              }
                              }
                              
                              $FindWinnerUp = null;
                              $FindWinnerUp = FindWinnerUp();
                              if($FindWinnerUp)
                              {
                                  if($FindWinnerUp->rowCount() >= 1)
                              {
                                  if($m2 == '1')
                                  {
                                      echo '<p class="text-center text-success">شما برنده مسابقه ما شدید !
                                      <br>
                                      پیامک دریافت جایزه ارسال شد !
                                      </p>';
                                  }
                                  if($m2 == '0')
                                  {
                                      echo '<p class="text-center text-info">متاسفانه شما برنده نشدید !</p>';
                                  }
                              }
                              }
                              else
                              {
                              if($m == 1)
                              {
						      echo '<p class="text-center text-success">برای قرعه کشی منتظر باشید !</p>';
                              }
						  else
						  {
						      echo '<p class="text-center text-danger"> برای شرکت در قرعه کشی پرداخت کنید ! </p>';
						  }
                              }
						  }
						  else
						  {
						      echo '<p class="text-success"> برای ثبت نام اطلاعات مورد نیاز را وارد کنید ! </p>';
						  }
						?>
						  
						  <?php
						  if(isset($_COOKIE["Empty"])) :
						  ?>
						  <div class="alert">
						  <p>
						  <?php echo $_COOKIE["Empty"]; ?>
						  </p>
						  </div>
						  <?php
						  endif;
						  ?>
						  
						  <?php
						  if(isset($_COOKIE["ErrorToken"])) :
						  ?>
						  <div class="alert">
						  <p>
						  <?php echo $_COOKIE["ErrorToken"]; ?>
						  </p>
						  </div>
						  <?php
						  endif;
						  ?>
						  
						  <?php
						  if(isset($_COOKIE["ErrorCode"])) :
						  ?>
						  <div class="alert">
						  <p>
						  <?php echo $_COOKIE["ErrorCode"]; ?>
						  </p>
						  </div>
						  <?php
						  endif;
						  ?>
						  
						  <?php
						  if(isset($_COOKIE["nopaypart2"])) :
						  ?>
						  <div class="alert">
						  <p>
						  <?php echo $_COOKIE["nopaypart2"]; ?>
						  </p>
						  </div>
						  <?php
						  endif;
						  ?>
						  
						  <?php
						  if(isset($_COOKIE["errorlimit"])) :
						  ?>
						  <div class="alert">
						  <p>
						  <?php echo $_COOKIE["errorlimit"]; ?>
						  </p>
						  </div>
						  <?php
						  endif;
						  ?>
						  
						  <?php
						  if(isset($_COOKIE["OkSendOTP"])) :
						  ?>
						  <div class="alert" style="background: green; opacity:0.8;">
						  <p>
						  <?php echo $_COOKIE["OkSendOTP"]; ?>
						  </p>
						  </div>
						  <?php
						  endif;
						  ?>
						  
						  <?php
						  if(isset($_COOKIE["OkSignUp"])) :
						  ?>
						  <div class="alert" style="background: green; opacity:0.8;">
						  <p>
						  <?php echo $_COOKIE["OkSignUp"]; ?>
						  </p>
						  </div>
						  <?php
						  endif;
						  ?>
						  
						  <?php
						  if(isset($_COOKIE["OkSignIn"])) :
						  ?>
						  <div class="alert" style="background: green; opacity:0.8;">
						  <p>
						  <?php echo $_COOKIE["OkSignIn"]; ?>
						  </p>
						  </div>
						  <?php
						  endif;
						  ?>
						  
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
						  
                        <form action="check.php" method="post">
                            <input class="form-control" type="text" name="name" placeholder="نام و نام خانوادگی" maxlength="22" autocomplete="off" value="<?php 
                            if(isset($_COOKIE["SingIning"]))
                            {
                                $FindUser = null;
                                $FindUser = FindUserByPhone($_COOKIE["SingIning"]);
                                if ($FindUser) {
                                $rows = $FindUser->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($rows as $row) 
                                {
                                    echo $row['name'];
                                }
                                }
                            }
                            else
                            {
                                echo $_COOKIE["name"];
                            }
                            ?>"
                          <?php
						  if(isset($_COOKIE["NextVison"]) || isset($_COOKIE["SingIning"])) 
						  {
						      echo 'readonly="readonly"';
						  }
						  ?> >
                            <input class="form-control" type="tel" name="phone" placeholder="شماره تلفن" maxlength="11" autocomplete="off" value="<?php 
                            if(isset($_COOKIE["SingIning"]))
                            {
                                $FindUser = null;
                                $FindUser = FindUserByPhone($_COOKIE["SingIning"]);
                                if ($FindUser) {
                                $rows = $FindUser->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($rows as $row) 
                                {
                                    echo $row['phone'];
                                }
                                }
                            }
                            else
                            {
                                echo $_COOKIE["phone"];
                            }
                            ?>"
						  <?php
						  if(isset($_COOKIE["NextVison"]) || isset($_COOKIE["SingIning"])) 
						  {
						      echo 'readonly="readonly"';
						  }
						  ?> >
						  <?php
						  if(isset($_COOKIE["NextVison"]) || isset($_COOKIE["SingIning"])) :
						  ?>
						  <input class="form-control" type="tel" name="code" placeholder="کد ارسالی را وارد کنید !" maxlength="5" autocomplete="off" value="<?php 
                            if(isset($_COOKIE["SingIning"]))
                            {
                                $FindUser = null;
                                $FindUser = FindUserByPhone($_COOKIE["SingIning"]);
                                if ($FindUser) {
                                $rows = $FindUser->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($rows as $row) 
                                {
                                    echo $row['idlottery'];
                                }
                                }
                            }
                            ?>"
                            <?php
                            if(isset($_COOKIE["SingIning"]))
                            {
                                echo 'readonly="readonly"';
                            }
                            ?>
                            >
						  <?php
						  endif;
						  ?>
						  <input type="hidden" name="token" value="<?php echo $Token; ?>">
						  
                            <div class="form-button">
                                <button <?php
						  if(isset($_COOKIE["NextVison"]) || isset($_COOKIE["SingIning"])) 
						  {
						      echo 'style="display: none;"';
						  }
						  ?> type="submit" name="submitSendCode" class="ibtn">ارسال اطلاعات</button>
                                
                                <button <?php
						  if(isset($_COOKIE["NextVison"])) 
						  {
						      echo 'style="display: block;"';
						  }
						  else
						  {
						      echo 'style="display: none;"';
						  }
						  ?> type="submit" name="submitSignUp" class="ibtn">ثبت نهایی</button>
						  
						  <button <?php
						  if(isset($_COOKIE["SingIning"])) 
						  {
						      $FindUser = null;
                              $FindUser = FindUserByPhone($_COOKIE["SingIning"]);
                              if ($FindUser) {
                              $rows = $FindUser->fetchAll(PDO::FETCH_ASSOC);
                              foreach ($rows as $row) 
                              {
                                    $m = $row['statuspay'];
                                    $m2 = $row['statuswin'];
                              }
                              }
                              if($m2 !==  '1')
                              {
                                  if($FindWinnerUp)
                                  {
                                      echo 'style="display: none;"';
                                  }
                                  if($m == 0)
                              {
						      echo 'style="display: block;"';
                              }
						  else
						  {
						      echo 'style="display: none;"';
						  }
						  }
						  else
						  {
						      echo 'style="display: none;"';
						  }
                              }
                              else
						  {
						      echo 'style="display: none;"';
						  }
                    
						  ?> type="submit" style="background: green;" name="SendPay" class="ibtn"> 
						  <?php
						  if($Amount == "")
						  {
						      echo 'ثبت نهایی';
						  }
						  else
						  {
						      echo 'پرداخت نهایی';
						  }
						  ?>
						  </button>
						   <button <?php
						  if(isset($_COOKIE["SingIning"])) 
						  {
						      $FindUser = null;
                              $FindUser = FindUserByPhone($_COOKIE["SingIning"]);
                              if ($FindUser) {
                              $rows = $FindUser->fetchAll(PDO::FETCH_ASSOC);
                              foreach ($rows as $row) 
                              {
                                    $m = $row['statuspay'];
                                    $m2 = $row['statuswin'];
                              }
                              }
                              $FindWinnerUp = null;
                              $FindWinnerUp = FindWinnerUp();
                              if($FindWinnerUp)
                              {
                                  if($FindWinnerUp->rowCount() >= 1)
                              {
                                  if($m2 == '1')
                                  {
                                      echo 'style="display: none;"';
                                  }
                                  if($m2 == '0')
                                  {
                                      echo 'style="display: none;"';
                                  }
                              }
                              }
                              else
                              {
                              if($m == 1)
                              {
						      echo 'style="display: block;"';
                              }
						  else
						  {
						      echo 'style="display: none;"';
						  }
                              }
						  }
						  else
						  {
						      echo 'style="display: none;"';
						  }
						  ?> type="button" style="background: green;" class="ibtn"> منتظر برای قرعه کشی ! </button>
						    <?php
                            if(isset($_COOKIE["SingIning"])) :
                            ?>
                            <a href="logout.php">
                            <button type="button" style="background: red;margin-top: 10px;" class="ibtn"> خروج از حساب کاربری </button>
                            </a>
                            <?php
                            endif;
                            ?>
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

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
