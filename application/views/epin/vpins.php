<div class="panel">
    <div class="heading">
        <span class="title">E-Pins</span>
    </div>

    <div class="content padding20">
        <a href="<?php echo site_url('EPins/buypins'); ?>" class="button info">Buy E-Pins</a>
        <table class="table border bordered">
            <tr>
                <td>Request ID</td>
                <td>Total Amount</td>
                <td>Request Date</td>
                
                <td>View Details</td>
               
            </tr>
            <?php
            if (isset($requests)) {
                foreach ($requests as $value) {
                    ?>
                    <tr>
                        <td><?php echo $value['req_id']; ?></td>
                        <td><?php echo $value['req_amt']; ?></td>
                        <td><?php echo $value['req_date']; ?></td>
                        
                        <td><a href="<?php echo site_url("EPins/viewpins/{$value['req_id']}"); ?>">Details</a></td>
                    </tr>
                    <?php
                }
            }
            ?>

        </table>
    </div>
</div>
