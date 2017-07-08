<div class="panel">
    <div class="heading">
        <span class="title">Vendors</span>
    </div>
    <div class="content padding20">
        <?php
        if (isset($vendors)) {
//            var_dump($vendors);
            ?>
            <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
                <thead>
                    <tr>
                        <td style="width: 20px">
                            SN
                        </td>
                        <td class="sortable-column sort-asc" style="width: 20px">ID</td>
                        <td class="sortable-column">Name</td>
                        <td class="sortable-column"style="width: 80px">Username</td>
                        <td class="sortable-column" style="width: 40px">Balance</td>
                        <td class="sortable-column" style="width: 20px">Status</td>
                        <td style="width: 20px">More</td>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $count = 1;
                    foreach ($vendors as $row) {
                        ?>   

                        <tr>
                            <td>
                                <?php echo $count; ?>
                            </td>
                            <td> <?php echo $row['us_id']; ?></td>
                            <td><?php echo $row['us_name']; ?></td>
                            <td><?php echo $row['acc_username']; ?></td>
                            <td><?php echo $row['balance']; ?></td>
                            <td class="align-center">
                                <?php
                                if ($row['acc_status'] == ACCOUNT_ACTIVE) {
                                    echo "Active";
                                } else {
                                    echo "Blocked";
                                }
                                ?>
        <!--                                <span class="mif-checkmark fg-green"></span>-->
                            </td>
                            <td>
                                <a href="<?php echo site_url("/Admin/Vendors/{$row['us_id']}"); ?>">Details</a>
                            </td>
                        </tr>


                        <?php
                        $count++;
                    }
                    ?>

                </tbody>
            </table>
    <?php
}
?>
                </div>
                </div>
