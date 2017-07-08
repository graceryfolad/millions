<div class="panel">
    <div class="heading">
        <div class="title">Merchants Details</div>
    </div>
    <div class="content padding20">
        <?php
        if (isset($type) && $type == ADMIN) {
            if ($merchant['mer_status'] == MERCHANT_APPROVED) {
                ?>
        <a href="<?php echo site_url("Merchant/Reject/{$merchant['mer_code']}");?>" class="button danger large">Disable Merchant</a> 
                <?php
            } else {
                ?>
                <a href="<?php echo site_url("Merchant/Approve/{$merchant['mer_code']}");?>" class="button success large">Approve Merchant Now</a>
                <?php
            }
        }
        ?>
        <h3>Merchant Profile</h3>
        <table class="table">
            <tr>
                <td>Merchant Name</td>
                <td><?php echo $merchant['mer_name'] ?></td>
            </tr>
            <tr>
                <td>Merchant Email</td>
                <td><?php echo $merchant['mer_email'] ?></td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td><?php echo $merchant['mer_phone'] ?></td>
            </tr>
            <tr>
                <td>Merchant Name</td>
                <td><?php echo $merchant['mer_name'] ?></td>
            </tr>
            <tr>
                <td>Merchant Status</td>
                <td><?php
                    if ($merchant['mer_status'] == MERCHANT_APPROVED) {
                        echo "<span class=\"button success large\">Merchant Approved</span>";
                    } elseif ($merchant['mer_status'] == MERCHANT_DECLINED) {
                        echo "<span class=\"button danger large\">Merchant Not Approved</span>";
                    }
                    ?></td>
            </tr>
        </table>

        <h3>Incentives</h3>
        <table>
            <tr>
                <td>Merchant Code</td>
                <td><?php echo $merchant['mer_code'] ?></td>
            </tr>
            <tr>
                <td>Incentive</td>
                <td><?php echo $merchant['mer_name'] ?></td>
            </tr>
        </table>
    </div>
</div>