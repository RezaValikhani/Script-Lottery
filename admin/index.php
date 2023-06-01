<?php 

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

include "block/header.php"; 

?>
<?php include "block/navigation.php"; ?>
<?php include "block/amar.php"; ?>

<!-- Page content -->
        <div class="container-fluid mt--7 text-right">
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3 class="mb-0">جدول کاربر ها</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">آیدی</th>
                                        <th scope="col">نام</th>
                                        <th scope="col">تلفن</th>
                                        <th scope="col">آیدی قرعه کشی</th>
                                        <th scope="col">تاریخ</th>
                                        <th scope="col">کد</th>
                                        <th scope="col">وضغیت</th>
                                        <th scope="col">وضعیت پرداخت</th>
                                        <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
					     	    $FindUser = null;
                                $FindUser = FindUsers();
                                if ($FindUser) {
                                $rows = $FindUser->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($rows as $row) :
                                ?>
                                    <tr>
                                        <td> <?php echo $row['id']; ?> </td>
                                        <td> <?php echo $row['name']; ?> </td>
                                        <td> <?php echo $row['phone']; ?> </td>
                                        <td> <?php echo $row['idlottery']; ?>  </td>
                                        <td> <?php echo $row['date']; ?> </td>
                                        <td> <?php echo $row['code']; ?>  </td>
                                        <td> <?php switch($row['statuswin'])
                                        {
                                        case 0;
                                        echo 'برنده نشده';
                                        break;
                                        case 1;
                                        echo 'برنده شده';
                                        break;
                                        }
                                        ?> </td>
                                        <td> <?php switch($row['statuspay'])
                                        {
                                        case 0;
                                        echo 'پرداخت نشده';
                                        break;
                                        case 1;
                                        echo 'پرداخت شده';
                                        break;
                                        }
                                        ?> </td>
                                        <th>
                                        <form action="check.php" method="post">
                                            
                                        <input name="IdUser" type="hidden" value="<?php echo $row['id']; ?>">
                                        <input name="NameUser" type="hidden" value="<?php echo $row['name']; ?>">
                                        <input name="PhoneUser" type="hidden" value="<?php echo $row['phone']; ?>">
                                        
                                        <button name="BtnDeleteUser" type="submit" class="btn btn-sm btn-danger" style="color:snow;border:none;cursor:pointer;outline:none;">
                                            حدف
                                        </button>
                                        <?php
                                        if($row['statuspay'] == '0') :
                                        ?>
                                        <button name="mmd1" type="submit" class="btn btn-sm btn-success" style="color:snow;border:none;cursor:pointer;outline:none;">
                                            اعطا بلیط
                                        </button>
                                        <?php
                                        endif;
                                        ?>
                                        <?php
                                        if($row['statuspay'] == '1') :
                                        ?>
                                        <button name="mmd0" type="submit" class="btn btn-sm btn-danger" style="color:snow;border:none;cursor:pointer;outline:none;">
                                            باطل کردن بلیط 
                                        </button>
                                        <?php
                                        endif;
                                        ?>
                                        </form>
                                        </th>
                                    </tr>
						    	<?php endforeach; ?>
						    	<?php } 
						    	else
						    	{
						    	    echo '<td class="text-danger">اطلاعاتی وجود ندارد !</td>';
						    	}
						    	?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            

<?php include "block/footer.php"; ?>