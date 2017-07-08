<div class="panel">
    <div class="heading">
        <span class="title">Wallet Top Up</span>
    </div>

    <div class="content padding20">
        <div class="">
            <?php
            if($utype ==VENDOR){
                ?>
            <form action="<?php echo site_url('Topup_wallet/Epin_topup');?>" method="post">
            <p><span >Top up with E-Pin</span><input type="text" name="pin" placeholder="Enter Pin here"/> <button class="button medium success" type="submit">Top Up</button></p>
            </form>
            
            <?php
            }
            ?>
                    
        </div>
        <table class="table border bordered">
            <tr>
                <td>S/N</td>
                
                <td>Fund Amount</td>
                <td>Fund From</td>
                <td>Fund To</td>
                <td>Fund Date</td>
                
                
               
            </tr>
            <?php
            if (isset($topups)) {
                $counter =1;
                foreach ($topups as $value) {
                    ?>
                    <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $value['amount']; ?></td>
                        <td><?php 
                        if($value['tp_from'] >0)
                        {
                            echo $value['tp_from'];
                        }
                        elseif($value['tp_from']==0){
                            echo "Admin";
                        }
                        ?></td>
                        <td>
                            <?php
                                echo $value['us_name'];
                            ?>
                        </td>
                        <td><?php echo $value['created']; ?></td>
                        
                    </tr>
                    <?php
                    $counter++;
                }
            }
            ?>

        </table>
    </div>
</div>
