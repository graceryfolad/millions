
<div class="panel">
    <div class="heading">
        <span class="title">Electricity</span>

    </div><!-- /.box-header -->
    <!-- form start -->

    <div class="content padding20">

        <div class="input-control select">
            <label for="exampleInputPassword1"> <b>Select Your Electricity Disco</b></label>
            <select class="" name="network" id="scode">

                <?php
                if (isset($services)) {
                    foreach ($services as $value) {
                        echo "<option value=\"{$value['ser_code']}\">{$value['ser_name']}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <br />
        <br />
        <div class="input-control text">
            <label for="exampleInputEmail1"><b>Meter/Customer Number</b></label>
            <input type="text" class="form-control" id="cust_num" placeholder="Enter Meter/Customer Number" name="order_for" required="required">
        </div>
        <br />
        <br />
        <div class="input-control text">
            <label for="exampleInputPassword1"> <b>Recharge Amount</b></label>
            <input type="text" class="form-control" id="amount" placeholder="Amount" name="amount" required="required">
        </div>
        <br />
        <br />
        <input type="hidden" name="cat" value="3" id="cat"/>
        <div class="box-footer">
            <input type="button" class="button info" name="SubmitOrder" value="Verify Order" onclick="Verify()"/>
        </div>


        <div id="verify">

        </div>
    </div><!-- /.box-body -->


</div><!-- /.box -->

<script>

    function Verify() {
        $('#verify').text('');
        var cat = $('#cat').val();
        var ser = $('#scode').val();
        var amt = $('#amount').val();
        var card = $('#cust_num').val();

        var postdata = {
            'network': ser,
            'order_for': card,
            'amount': amt,
            'cat': cat,
            'SubmitVerify': '1'
        };

        $.ajax({
            url: "<?php echo site_url('/Order/Verify'); ?>", //The url where the server req would we made.

            type: "POST", //The type which you want to use: GET/POST
            data: postdata, //The variables which are going.
//            dataType: "html", //Return data type (what we expect).
            datatype: 'json',
            //This is the function which will be called if ajax call is successful.
            success: function (data) {
                //data is the html of the page where the request is made.


                $('#verify').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#verify').html(jqXHR.status);

            }
        });

    }

</script>

