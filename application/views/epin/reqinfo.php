<div class="panel">
    <div class="heading">
        <span class="title">Request Information</span>
    </div>

    <div class="content padding20">
        <?php
        if (isset($reqinfo)) {
            ?>
        <table class="table border bordered">
                <thead>
                    <tr>
                        <th>Pin Code</th>
                        <th>Pin Value</th>
                        <th>Pin Quantity</th>
                        <th>Total Amount</th>
                        <th>Pins</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($reqinfo as $value) {
                        $amt = $value['pin_value'] * $value['pin_count'];
                        ?>
                        <tr>
                            <td><?php echo $value['pin_code']; ?></td>
                            <td><?php echo $value['pin_value']; ?></td>
                            <td><?php echo $value['pin_count']; ?></td>
                            <td><?php echo $amt; ?></td>
                            <td> <a href="<?php echo site_url("EPins/ShowPins/{$value['req_id']}/{$value['pin_code']}");?>" class="button info">View Pins</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } elseif (isset($pindets)) {
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Pin Value</th>
                        <th>Pin Serial</th>
                        <th>Pin Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($reqinfo as $value) {
                        $amt = $value['pin_value'] * $value['pin_count'];
                        ?>
                        <tr>
                            <td>Pin Code</td>
                            <td>Pin Value</td>
                            <td>Pin Quantity</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        }
        ?>
    </div>
</div>