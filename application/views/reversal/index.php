<div class="panel">
    <div class="heading">
        <span class="title">Reversals</span>
    </div>
    <div class="content padding20">
        <p class="bg-red padding20 fg-white">
        <?php
            if(isset($status)){
                echo $status;
            }
        ?>
            
        </p>
        <label>Enter the Order ID</label> <input id='orid' class="form-control" required="required"/><button type="button" id='click' onclick="GetOrderInfo()" class="button info large">Submit</button>
        
        
        <div id="ordinfo">
            
        </div>
    </div>
</div>

<script>

    function GetOrderInfo()
    {
        var id = $('#orid').val();

        

        var postdata = {
            'orderid': id,
            


        };

        $.ajax({
            url: "<?php echo site_url('/Reversal/GetInfo'); ?>", //The url where the server req would we made.

            type: "POST", //The type which you want to use: GET/POST
            data: postdata, //The variables which are going.
//            dataType: "html", //Return data type (what we expect).
            datatype: 'json',
            //This is the function which will be called if ajax call is successful.
            success: function (data) {
                //data is the html of the page where the request is made.
                

                $('#ordinfo').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#error').html(jqXHR.status);

            }
        });

    }

</script>


