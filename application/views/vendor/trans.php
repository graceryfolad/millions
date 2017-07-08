<div class="panel">
    <div class="heading">
        <span class="title">Transactions</span>
    </div>
    <div class="content padding20">
        <?php
        if (isset($trans)) {
            ?>

            
                

                <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
                    <thead>
                        <tr>
                            <td style="width: 20px">
                                SN
                            </td>
                            <td class="sortable-column sort-asc" style="width: 80px">Order ID</td>
                            <td class="sortable-column sort-asc" style="width: 80px">Order Date</td>
                            
                            <td class="sortable-column" style="width: 100px">Service</td>
                            <td class="sortable-column" style="width: 100px">Destination</td>
                            <td class="sortable-column" style="width: 100px">Amount</td>
                            <td class="sortable-column" style="width: 60px">Commission</td>
                            <td class="sortable-column" style="width: 20px">Status</td>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $count = 1;
                        foreach ($trans as $row) {
                            ?>   

                            <tr>
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td> <?php echo $row['ord_id']; ?></td>
                                <td> <?php echo $row['ord_date']; ?></td>
                                
                                <td><?php echo $row['ser_name']; ?></td>
                                <td><?php echo $row['ord_for']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $row['ord_comm']; ?></td>
                                <td class="align-center">
                                    <?php
                                    if ($row['ord_status'] == ORDER_SUCCESS) {
                                        echo "<button class=\"button success\"> Success</button>";
                                    } else {
                                        echo "<button class=\"button danger\"> Failed</button>";
                                    }
                                    ?>
            <!--                                <span class="mif-checkmark fg-green"></span>-->
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
