<div class="panel">
    <div class="heading">
        <span class="title">Pin Details</span>
    </div>

    <div class="content padding20">

        <table class="table border bordered">
            <tr>
                <td>Pin Code</td>
                <td>Pin Value</td>
                <td>Pin Serial</td>
                <td>Pin Batch</td>
                <td>Pin Status</td>
            </tr>
            <?php
            if (isset($mypins)) {
                foreach ($mypins as $value) {
                    ?>
                    <tr>
                        <td><?php echo $value['pin_code']; ?></td>
                        <td><?php echo $value['pin_value']; ?></td>
                        <td><?php echo $value['pin_serial']; ?></td>
                        <td><?php echo $value['pin_batch']; ?></td>
                        <td><?php 
                        if($value['pin_used'] ==1)
                        {
                            echo "<span class=\"button danger\">Used</span>";
                        }
                        else{
                            echo "<span class=\"button success\">Not Used</span>";
                        }
                        ?></td>
                    </tr>
                    <?php
                }
            }
            ?>

        </table>
    </div>
</div>