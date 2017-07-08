<form action="<?php echo site_url('Reversal/Reverse'); ?>" method="post">
    <input type="hidden" name="orid" value="<?php echo $orderinfo['ord_id']; ?>" />
    <table class="table" style="width: 50%;">
        <tr>
            <td>Order ID</td>
            <td><?php echo $orderinfo['ord_id'] ?></td>
        </tr>
        <tr>
            <td>Service</td>
            <td><?php echo $orderinfo['ser_name'] ?></td>
        </tr>
        <tr>
            <td>Amount</td>
            <td><?php echo $orderinfo['amount'] ?></td>
        </tr>
        <tr>
            <td>Commission</td>
            <td><?php echo $orderinfo['ord_comm'] ?></td>
        </tr>
        <tr>
            <td>Vendor</td>
            <td><?php echo $orderinfo['us_name'] ?></td>
        </tr>

        <tr>
            <td>Date</td>
            <td><?php echo $orderinfo['ord_date'] ?></td>
        </tr>
        <tr>
            <td>Order Status</td>
            <td><?php
                if ($orderinfo['ord_status'] == ORDER_SUCCESS) {
                    echo "<span class=\"button success large\">Successful</span>";
                } elseif ($orderinfo['ord_status'] == ORDER_FAILED) {
                    echo "<span class=\"button danger large\">Failed</span>";
                }
                ?></td>
        </tr>
        <tr>
            <td>Reason for Reversal</td>
            <td>
                <textarea name="reason">State your reason here</textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name='rev_submit' value="Reverve Now" class="button info large"/></td>
        </tr>
    </table>
</form>