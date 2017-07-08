<div class="panel ">
    <div class="heading">
        <span class="title">Fund Transfer</span>
    </div>
    <div class="content padding20">


        <?php
        if (isset($trfund_msg)) {
            echo "<button class=\"button success\">{$trfund_msg}</button>";
        } elseif (isset($trfund_error)) {
            echo "<button class=\"button alert\">{$trfund_error}</button>";
        }
        ?>
        <br />
        <br />
        <div class="input-control text">
            <label for=""><b>Receiver's Username</b></label>
            <input type="text" class="form-control" id="rec_tran" placeholder="Enter Username" name="transf_to" required="required">
        </div>
        <br />
        <br />
        <div class="input-control text">
            <label for="exampleInputPassword1"> <b>Amount to Transfer</b></label>
            <input type="text" class="form-control" id="amt" placeholder="Amount" name="amount" required="required">
        </div>
        <div class="box-footer">
            <input type="button" class="button info" name="SubmitOrder" value="Verify User" onclick="verify()"/>
        </div>



        <div id="userinfo"></div>
    </div>
</div>

<script>
    function verify()
    {
        var phone = $('#rec_tran').val();

        var amount = $('#amt').val();
        if(amount >= 10)
        {
        var postdata = {
            'phone': phone,
            'amt': amount


        };

        $.ajax({
            url: "<?php echo site_url('/User/GetUserInfo'); ?>", //The url where the server req would we made.

            type: "POST", //The type which you want to use: GET/POST
            data: postdata, //The variables which are going.
//            dataType: "html", //Return data type (what we expect).
            datatype: 'json',
            //This is the function which will be called if ajax call is successful.
            success: function (data) {
                //data is the html of the page where the request is made.


                $('#userinfo').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#userinfo').html(jqXHR.status);

            }
        });
        
        }
        else{
             $('#userinfo').html("<p>Invalid Amount</p>");
        }

    }

</script>