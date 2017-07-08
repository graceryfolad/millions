<div class="panel">
    <div class="heading">
        <div class="title">Merchants</div>
    </div>
    <div class="content padding20">
        <a class="button info" href="<?php echo site_url('/Loyalty/NewMerchant'); ?>">Register New Merchant</a>
        <a class="button info">Purchases</a>
        <a class="button info">Purchases Report</a>

        <div class="">
            <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
                <thead>
                    <tr>
                        <td style="width: 20px">
                            SN
                        </td>
                        <td class="sortable-column sort-asc" style="width: 80px">Code</td>
                        <td class="sortable-column sort-asc" style="width: 20px">Merchant Name</td>

                        <td class="sortable-column" style="width: 100px">Account Status</td>
                        <td class="sortable-column" style="width: 100px">Details</td>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($merchants)) {
                        $count = 1;
                        foreach ($merchants as $row) {
                            ?>   

                            <tr>
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td> <?php echo $row['mer_code']; ?></td>
                                <td> <?php echo $row['mer_name']; ?></td>

                                <td>
                                    <?php
                                    if ($row['mer_status'] == MERCHANT_APPROVED) {
                                        echo "<button class=\"button success\"> Active</button>";
                                    } elseif ($row['mer_status'] == MERCHANT_DECLINED) {
                                        echo "<button class=\"button warning\"> Awaiting Aproval</button>";
                                    } 
                                    ?>
                                </td>
                                <td><a href="<?php echo site_url("Loyalty/AMerchant/{$row['mer_code']}");  ?>">Details</a></td>
                                
                                

                            </tr>


        <?php
        $count++;
    }
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
