<div class="panel">
    <div class="heading">
        <span class="title">Pin Batch Details</span>
    </div>

    <div class="content padding20">

        <table class="table">
            <tr>
                <td>Pin Code</td>
                <td>Pin Value</td>
                <td>Pin Serial</td>
                <td>Pin Batch</td>
                <td>Pin Usage</td>
            </tr>
            <?php
            if (isset($pins)) {
                foreach ($pins as $value) {
                    ?>
                    <tr>
                        <td><?php echo $value['pin_code']; ?></td>
                        <td><?php echo $value['pin_value']; ?></td>
                        <td><?php echo $value['pin_serial']; ?></td>
                        <td><?php echo $value['pin_batch']; ?></td>
                        <td><?php echo $value['pin_usedby']; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>

        </table>
    </div>
</div>