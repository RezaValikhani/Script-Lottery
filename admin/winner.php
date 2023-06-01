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
                            <h3 class="mb-0">جدول برندگان</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">آیدی</th>
                                        <th scope="col">نام</th>
                                        <th scope="col">تلفن</th>
                                        <th scope="col">تاریخ</th>
                                        <th scope="col">آیدی قرعه کشی</th>
                                        <th scope="col">هش</th>
                                        <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
					     	    $FindWinner = null;
                                $FindWinner = FindWinner();
                                if ($FindWinner) {
                                $rows = $FindWinner->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($rows as $row) :
                                ?>
                                    <tr>
                                        <td> <?php echo $row['id']; ?> </td>
                                        <td> <?php echo $row['name']; ?> </td>
                                        <td> <?php echo $row['phone']; ?> </td>
                                        <td> <?php echo $row['date']; ?> </td>
                                        <td> <?php echo $row['idlottery']; ?> </td>
                                        <td> <?php echo $row['hash']; ?> </td>
                                        
                                        <th>
                                        <form action="check.php" method="post">
                                        <input name="IdUser" type="hidden" value="<?php echo $row['id']; ?>">
                                        <input name="NameUser" type="hidden" value="<?php echo $row['name']; ?>">
                                        <input name="PhoneUser" type="hidden" value="<?php echo $row['phone']; ?>">
                                        <button name="BtnDeleteWinner" type="submit" class="btn btn-sm btn-danger" style="color:snow;border:none;cursor:pointer;outline:none;">
                                            حدف
                                        </button>
                                        
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