<div class="panel">
    <div class="heading">
        <span class="icon mif-info"></span>
        <span class="title">Transaction Status</span>
    </div>
    <div class="content padding20">
        <?php
        if (isset($status)) {
            ?>


            <table class="table table-bordered">
                <tr>
                    <td style="width: 100px;">Service</td>
                    <td><?php echo $status['ser_name']; ?></td>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td><?php echo $status['amount']; ?></td>
                </tr>
                <tr>
                    <td>Destination</td>
                    <td><?php echo $status['ord_for']; ?></td>
                </tr>
                <tr>
                    <td>Commission</td>
                    <td>N<?php echo $status['ord_comm']; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><?php
                        if ($status['ord_status'] == ORDER_SUCCESS) {
                            echo "<button class=\"button success\">Successful</button>";
                        } else {
                            echo "<button class=\"button danger\">Failed</button>";
                        }
                        ?></td>
                </tr>
                <?php
                    if(isset($waecpins)){
                        ?>
                <tr>
                    <td>Pin Details</td>
                    <td>
                        <?php
                                foreach ($waecpins as $value) {
                                    echo "Serial Number :<b> {$value['sn']} </b><br/> Pin: <b>{$value['pn']}</b>";
                                }
                        ?>
                    </td>
                </tr>
                <?php
                    }
                    elseif(isset ($ikjpre)){
                        ?>
                 <tr>
                    <td>Token</td>
                    <td>
                        <?php
                                $tk = split_token($ikjpre);
                                    echo "<b> {$tk}</b>";
                        ?>
                    </td>
                </tr>
                <?php
                    }
                ?>
                <tr>
                    <td>Date</td>
                    <td><?php echo $status['ord_date']; ?></td>
                </tr>
            </table>
    <?php
} else {
    echo "<h3>{$fail}</h3>";
}
?>

        <a href="<?php echo site_url('/Vendor/Services/1'); ?>" class="button primary">Sell Airtime </a>
        <a href="<?php echo site_url('/Vendor/Services/2'); ?>" class="button primary">TV Subscription</a>
    </div>
</div>

