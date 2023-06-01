<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */
 
?>

<!-- Header -->
            <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8 text-right">
                    <div class="container-fluid">
                        <div class="header-body">
                            <!-- Card stats -->
                            <div class="row">
                                <div class="col-xl-3 col-lg-6">
                                    <div class="card card-stats mb-4 mb-xl-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">آمار</h5>
                                                    <span class="h2 font-weight-bold mb-0"><?php 
						                $FindUserCount = null;
                                        $FindUserCount = FindUsers();
                                        if($FindUserCount)
                                        {
                                        echo number_format($FindUserCount->rowCount());
                                        }
                                        else
                                        {
                                            echo "0";
                                        }
                                        ?>
                                        </span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                        <i class="fas fa-chart-bar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-muted text-sm text-right">
                                                <span class="text-success ml-2">کل مشتری ها</span>
                                                <span class="text-nowrap">در سایت  </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6">
                                    <div class="card card-stats mb-4 mb-xl-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0"> تعداد برندگان </h5>
                                                    <span class="h2 font-weight-bold mb-0"><?php
					     	    $FindWinner = null;
                                $FindWinner = FindWinner();
                                if($FindWinner)
                                {
                                echo number_format($FindWinner->rowCount());
                                }
                                else
                                {
                                    echo '0';
                                }
                                ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                        <i class="fas fa-chart-pie"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-muted text-sm">
                                                <span class="text-success ml-2"> تمام محصولات </span>
                                                <span class="text-nowrap">در سایت </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6">
                                    <div class="card card-stats mb-4 mb-xl-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0"> پرداختی ها </h5>
                                                    <span class="h2 font-weight-bold mb-0"><?php 
						                $FindUserPaying = null;
                                        $FindUserPaying = FindUserPaying();
                                        if($FindUserPaying)
                                        {
                                        echo number_format($FindUserPaying->rowCount());
                                        }
                                        else
                                        {
                                            echo "0";
                                        }
                                        ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                                        <i class="fas fa-users"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-muted text-sm">
                                                <span class="text-success ml-2">تکمیل شده</span>
                                                <span class="text-nowrap">در سایت  </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6">
                                    <div class="card card-stats mb-4 mb-xl-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0"> درامد این لاتاری </h5>
                                                    <span class="h2 font-weight-bold mb-0">
                                                        <?php 
						                $FindUserPaying = null;
                                        $FindUserPaying = FindUserPaying();
                                        if($FindUserPaying)
                                        {
                                        echo number_format($FindUserPaying->rowCount() * $Amount);
                                        }
                                        else
                                        {
                                            echo "0";
                                        }
                                        ?>
                                                        </span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                                        <i class="fas fa-percent"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-muted text-sm">
                                                <span class="text-success ml-2">عدد</span>
                                                <span class="text-nowrap">در سایت</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>