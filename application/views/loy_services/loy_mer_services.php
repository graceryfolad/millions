<table class="dataTable" data-role="datatable">
    <thead>
        <tr>
            <th>S/N</th>
            <th>Code</th>
            <th>Name</th>
            <th>Percent</th>
            <th>Min. Amount</th>
            <th>Status</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($services) && count($services) > 0) {
            $count =1;
            
            foreach ($services as $value) {
                ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $value['loy_ser_id']; ?></td>
                    <td><?php echo $value['loy_ser_name']; ?></td>
                    <td><?php echo $value['loy_ser_per']; ?>%</td>
                    <td>N<?php echo $value['loy_ser_min_amount']; ?></td>
                    <td><?php echo $value['loy_status']; ?></td>
                    <td> <a href="<?php echo site_url("Loy_Services/get_service/{$value['loy_ser_id']}"); ?>">Details </a></td>
                </tr>
                <?php
                $count++;
            }
        } else {
            echo "No record found";
        }
        ?>
    </tbody>
</table>
