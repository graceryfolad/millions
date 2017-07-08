<div class="panel padding5">
    <div class="heading">
        <span class="title">Vendor Details</span>
    </div>
    <div class="content padding20">
        <?php
        if (isset($vendordet) && count($vendordet) > 0) {
            ?>



            <div class="grid">
                <div class="row cells11" >
                    <div class="cell colspan6">
                        <div class="">
                            <table class="table table-bordered">
                                <tr>
                                    <td style="width: 170px;">Name</td>
                                    <td><b><?php
                                            echo strtoupper($vendordet['us_name']);
                                            ?></b></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><b><?php
                                            echo $vendordet['us_email'];
                                            ?></b></td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td><b><?php
                                            echo $vendordet['us_phone'];
                                            ?></b></td>
                                </tr>
                                <tr>
                                    <td>Vendor Balance</td>
                                    <td><b><?php
                                            echo $vendordet['balance'];
                                            ?></b></td>
                                </tr>
                                <tr>
                                    <td>Vendor Type</td>
                                    <td><b><?php
                                            echo $vpack['pack_name'];
                                            ?></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="cell colspan5">
                        <h3 class="sub-header center" style="text-align: center;">Fund Vendor Wallet</h3>
                        <form action="<?php echo site_url('/Wallet/Topup'); ?>" method="post">
                            <input type="hidden" name="vendor" value="<?php echo $vendordet['us_id']; ?>" />
                            <table>
                                <tr>
                                    <td style="width: 170px;">Balance</td>
                                    <td><input type="text" name="balance" class="input-control text" value="<?php echo $vendordet['balance'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Amount to fund</td>
                                    <td><input type="text" name="famt" class="input-control text" placeholder="Amount to fund the vendor"/></td>

                                </tr>
                                <tr>
                                    <td>Fund Remark</td>
                                    <td><input type="text" name="remark" class="input-control text" placeholder="Note on fund"/></td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" name="submit" value="Add Fund" class="button success"/></td>

                                </tr>
                            </table>

                        </form>

                    </div>
                </div>
            </div>
            <div class="clear-float"></div>
            <div class="cell colspan5">
                <h3 class="sub-header center" style="text-align: left;">Change Password</h3>
                <div id="accinfo"></div>
                    <input type="hidden" id="acc_id" value="<?php echo $vendordet['acc_id']; ?>" />
                    <table>
                        <tr>
                            <td style="width: 170px;">New Password</td>
                            <td><input type="password" id="psone" class="input-control text" value="" placeholder="New Password"></td>
                        </tr>
                        <tr>
                            <td>Retype Password</td>
                            <td><input type="password" id="pstwo" class="input-control text" placeholder="Retype Password"/></td>

                        </tr>

                        <tr>
                            <td></td>
                            <td><button type="button" class="button success" onclick="PassChange()">Change Password</button></td>

                        </tr>
                    </table>

               

            </div>
            <div class="box">
                <h3>Transactions</h3>

                <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
                    <thead>
                        <tr>
                            <td style="width: 20px">
                                SN
                            </td>
                            <td class="sortable-column sort-asc" style="width: 80px">Order ID</td>
                            <td class="sortable-column sort-asc" style="width: 80px">Order Date</td>
                            <td class="sortable-column" style="width: 100px">Service</td>
                            <td class="sortable-column" style="width: 70px">Destination</td>
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
            </div>

            <?php
        }
        ?>
    </div>
</div>

 <script>

    function PassChange()
    {
        
        var pass1= $('#psone').val();
        var pass2= $('#pstwo').val();
        var acid= $('#acc_id').val();
        var postdata = {
            'password1': pass1,
            'password2': pass2,
            'acc_id': acid


        };


        $.ajax({
            url: "<?php echo site_url('/Account/AdChangePW'); ?>", //The url where the server req would we made.

            type: "POST", //The type which you want to use: GET/POST
            data: postdata, //The variables which are going.
//            dataType: "html", //Return data type (what we expect).
            datatype: 'json',
            //This is the function which will be called if ajax call is successful.
            success: function (data) {
                //data is the html of the page where the request is made.


                $('#accinfo').html(data);
                $('#psone').val("");
                $('#pstwo').val("");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#error').html(jqXHR.status);

            }
        });

    }

</script>