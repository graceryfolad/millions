<?php
if (isset($verify)) {
    ?>
    <form method="post" action="<?php echo site_url('/Order/add'); ?>">
        <table class="table condensed cells5">
            <tr>
                <td style="width: 75px;">Service</td>
                <td style="width: 130px;"><b><?php echo $verify['service']; ?></b></td>
            </tr>
            <tr>
                <td>Customer Name</td>
                <td><b><?php echo $verify['name']; ?> </b></td>
            </tr>
            <tr>
                <td>Amount to Pay</td>
                <td><b><?php echo $verify['amount']; ?> </b></td>
            </tr>
            <tr>
                <td>Customer Number</td>
                <td><b><?php echo $verify['card']; ?> </b></td>
            </tr>
            <?php
            if (isset($verify['outstanding'])) {
                ?> 
                <tr>

                    <td>Outstanding Amount</td>
                    <td><b><?php echo $verify['outstanding']; ?> </b></td>
                </tr>
                <?php
            }
            ?>


            <tr>
                <td></td>
                <td>
                    <input type="hidden" name="network" value="<?php echo $verify['scode']; ?>" />
                    <input type="hidden" name="cat" value="<?php echo $verify['cat']; ?>" />
                    <input type="hidden" name="amount" value="<?php echo $verify['amount']; ?>" />
                    <input type="hidden" name="order_for" value="<?php echo $verify['card']; ?>" />

                    <input type="submit" name="" value="Confirm Order" class="button info" />
                </td>
            </tr>
        </table>
    </form>

    <?php
} else {
    echo "No record found";
}
?>