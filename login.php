<?php 

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */
 
session_start();
include "init.php";
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Creative Tim">
    <!-- Favicon -->
    <link href="assets/images/fuu.svg" rel="icon" type="image/png">
    <!-- Title -->
    <title> پنل مدیریت -  ورود ادمین  </title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="admin/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="admin/assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/farsi-font.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/mmd.css">
</head>
<body>    
<div class="m"></div>
    <div class="form-body without-side">
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
                        <div class="grey">
                      <h3>پنل مدیریت</h3>
                     <p class="text-success"> 
                     ایمیل و رمز خود را وارد کنید !
                        </p>
                            
                            <?php
                            if(isset($_COOKIE["empty"])) :
                            ?>
                            <div class="text-center">
                                    <button type="submit" class="btn btn-danger mb--3 mt-3">
                                    <?php echo $_COOKIE["empty"];?>
                                    </button>
                            </div>
                           <?php
                           endif;
                           ?>
                           
                           <?php
                            if(isset($_COOKIE["NoSingIningAdmin"])) :
                            ?>
                            <div class="text-center">
                                    <button type="submit" class="btn btn-danger mb--3 mt-3">
                                    <?php echo $_COOKIE["NoSingIningAdmin"];?>
                                    </button>
                            </div>
                           <?php
                           endif;
                           ?>
                           
                     
                        <div class="card-body">
                            <form role="form" action="check.php" method="post">
                                <div class="form-group mb-3">
                                        <input name="email" class="form-control" placeholder="info@sourcesaaz.ir" type="email" autocompelete="off">
                                </div>
                                <div class="form-group mb-3">
                                        <input name="password" class="form-control" placeholder="••••••••" type="password" autocompelete="off">
                                </div>
                                    <div class="form-button">
                           <button type="submit" name="BtnRequestLogin" class="ibtn">ورود</button>
         </div>
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
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="admin/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="admin/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Argon JS -->
    <script src="admin/assets/js/argone209.js?v=1.0.0"></script>
</body>
</html>