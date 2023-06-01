<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

?>
<!-- Sidenav -->
    <nav class="navbar navbar-vertical fixed-right navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand pt-0" href="index.php">
                <img src="https://sevenservice.ir/assets/uploads/user356a192b7913b04c54574d18c28d46e6395428ab/5cadaa004d3e10fab205ea06b0843728.png" class="navbar-brand-img" alt="...">
            </a>
            <!-- User -->
            <ul class="nav align-items-center d-md-none">
                <!--
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ni ni-bell-55"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-left text-right" aria-labelledby="navbar-default_dropdown_1">
                        <a class="dropdown-item" href="#">عملیات</a>
                        <a class="dropdown-item" href="#">عملیات دیگر</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">گزینه های بیشتر اینجا</a>
                    </div>
                </li>
                -->
                <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="assets/img/theme/profile-cover.png">
                                </span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-left text-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">خوش آمدید!</h6>
                            </div>
                            <a href="index.php" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>داشبورد</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="../logout.php" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>خروج</span>
                            </a>
                        </div>
                    </li>
            </ul>
            <!-- Collapse -->
            <div class="collapse navbar-collapse text-right" id="sidenav-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="index.php">
                                <img src="https://sevenservice.ir/assets/uploads/user356a192b7913b04c54574d18c28d46e6395428ab/5cadaa004d3e10fab205ea06b0843728.png">
                            </a>
                        </div>
                        <div class="col-6 collapse-close text-left">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <form class="mt-4 mb-3 d-md-none">
                    <div class="input-group input-group-rounded input-group-merge">
                        <input style="color: black; cursor: not-Allowed;" type="search" class="form-control form-control-rounded form-control-prepended" value="کاربر ها : <?php 
						                $FindUserCount = null;
                                        $FindUserCount = FindUsers();
                                        if($FindUserCount)
                                        {
                                        echo number_format($FindUserCount->rowCount());
                                        }
                                        else
                                        {
                                            echo '0';
                                        }
                                        ?>" aria-label="Search" disabled="disabled">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-wallet"></span>
                            </div>
                        </div>
                    </div>
                </form>
				
				                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="ni ni-tv-2 text-primary"></i> داشبورد
                        </a>
                    </li>
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="adduser">-->
                    <!--        <i class="ni ni-pin-3 text-orange"></i> -->
                    <!--    </a>-->
                    <!--</li>-->
                    <li class="nav-item">
                        <a class="nav-link" href="winner.php">
                            <i class="ni ni-bullet-list-67 text-red"></i> 
                            جدول برندگان
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../lottery.php">
                            <i class="ni ni-planet text-blue"></i> 
                            قرعه کشی کردن
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            <i class="ni ni-key-25 text-info"></i>
                            <form action="check.php" method="post">
                                 <button name="BtnResetLottery" type="submit" class="btn btn-sm bg-success" style="color:snow;border:none;cursor:pointer;outline:none;"> ریست کردن قرعه کشی </button>
                            </form>
                        </a>
                    </li>
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="numbers">-->
                    <!--        <i class="ni ni-single-02 text-yellow"></i> -->
                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="testnumber">-->
                    <!--        <i class="ni ni-key-25 text-info"></i> -->
                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="autobomber">-->
                    <!--        <i class="ni ni-circle-08 text-primary"></i>-->
                    <!--    </a>-->
                    <!--</li>-->
                </ul>
                 <!--Divider -->
                <hr class="my-3">
                 <!--Heading -->
                
                <h6 class="navbar-heading text-muted"> گزینه ها بیشتر </h6>
                
                 <!--Navigation -->
                
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="../">
                            <i class="ni ni-single-copy-04"></i> رفتن به صفحه اصلی
                        </a>
                    </li>
                </ul>
               
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content">
        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="index.php">داشبورد</a>
                <!-- Form -->
                <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i style="color: snow;" class="fas fa-wallet"></i></span>
                            </div>
                            <input style="cursor: not-Allowed; width: auto;" class="form-control pr-0 pl-3" value="کاربر ها : <?php 
						                $FindUserCount = null;
                                        $FindUserCount = FindUsers();
                                        if($FindUserCount)
                                        {
                                        echo number_format($FindUserCount->rowCount());
                                        }
                                        else
                                        {
                                            echo '0';
                                        }
                                        ?>" type="text" disabled="disabled">
                        </div>
                    </div>
                </form>
				
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pl-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="assets/img/theme/profile-cover.png">
                                </span>
                                <div class="media-body mr-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">
                                        <?php
                                        $FindAdminByEmail = null;
                                        $FindAdminByEmail = FindAdminByEmail($_SESSION["email"]);
                                        if ($FindAdminByEmail) 
                                        {
                                        $rows = $FindAdminByEmail->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($rows as $row) 
                                        {
                                        echo $row['name'];
                                        }
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-left text-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">خوش آمدید!</h6>
                            </div>
                            <a href="<?php echo $Domain; ?>" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>رفتن به سایت</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="../logout.php" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>خروج</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>