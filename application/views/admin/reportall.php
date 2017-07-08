
<div class="panel">
    <div class="heading">
        <span><?php
            if (isset($rtitle)) {
                echo $rtitle;
            }
            ?></span>
    </div>
    <div class="content">
        <?php
        if (isset($report) && is_array($report) >0) {
            
            ?>
            <table border="1">
                <thead>
                    <tr>
                        <td>Services</td>
                        <td>Num. of Trans</td>
                        <td>Total Amount</td>
                        <td>Total Commission</td>
                    </tr>


                </thead>

                <?php
                $totalsales=0;
                $totalcomm =0;
                foreach ($report as $row) {
                    ?>
                    <tr>
                        <td><?php echo $row['ser_name']?></td>
                        <td><?php echo $row['NumberofOrder']?></td>
                        <td><?php echo number_format($row['TotalAmount'], 2, '.', ',');?></td>
                        <td><?php echo number_format($row['Commission'], 2, '.', ',');?></td>
                    </tr>
                    <?php
                    $totalsales = $totalsales + $row['TotalAmount'];
                    $totalcomm = $totalcomm +$row['Commission'];
                }
                ?>
                  <tr>
                        <td>Totals</td>
                        <td>-</td>
                        <td><?php echo number_format($totalsales, 2, '.', ','); ?></td>
                        <td><?php echo number_format($totalcomm, 2, '.', ',');?></td>
                    </tr>  
            </table>
            <?php
        } else {
            echo "No record found";
        }
        ?>
    </div>
</div>