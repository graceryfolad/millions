<div class="panel">
    <div class="heading">
        <span class="title">Add Member Purchase</span>
    </div>
    <div class="content padding20">
        
        <div id="add" class="padding10"></div>
        <?php
            if(isset($services) && count($services)>0){
               ?>
        <div class="input-control select full-size">
            <label>Select a Service</label><br/>
        <select class="select" id="serid">
            <?php
                           foreach ($services as $value) {
                               echo "<option value=\"{$value['loy_ser_id']}\">{$value['loy_ser_name']}</option>";
                           }
            ?>
        </select>
        </div>
        <br/>
        <br/>
        <br/>
        <div class="input-control text full-size">
            <label>Enter the Amount</label><br/>
        <input type="text" placeholder="Enter total amount per service" id="amount"/>
        <input type="hidden" id="memid" value="<?php  echo $memdet['us_id'];?>"/>
        </div>
        <br/>
        <br/>
        <br/>
        <button class="button success large" onclick="AddCart()">Add to Cart</button>
                <?php
            }
            else{
                echo "No service is available for Merchant";
            }
        ?>
        
        <div id="Cartinfo"></div>
    </div>
</div>


<script>
function AddCart()   
{
//    get the values
    var usid=$('#memid').val();
    var ser = $('#serid').val();
    var amt = $('#amount').val();
 
    var postdata = {
            'uid': usid,
            'sid':ser,
            'amt':amt
         };
         
         $.ajax({
            url: "<?php echo site_url('/Purchase/addCart'); ?>", //The url where the server req would we made.

            type: "POST", //The type which you want to use: GET/POST
            data: postdata, //The variables which are going.
//            dataType: "html", //Return data type (what we expect).
            datatype: 'json',
            //This is the function which will be called if ajax call is successful.
            success: function (data) {
                //data is the html of the page where the request is made.

                
                $('#add').html(data);
                setTimeout(function () {
                    
                    $('#add').remove();
                   GetCart();
                }, 4000);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#add').html(jqXHR.status);

            }
        });
}

function GetCart()   
{
//    get the values
    var usid=$('#memid').val();
    
 
    var postdata = {
            'uid': usid,
            
         };
         
         $.ajax({
            url: "<?php echo site_url('/Purchase/GetCart'); ?>", //The url where the server req would we made.

            type: "POST", //The type which you want to use: GET/POST
            data: postdata, //The variables which are going.
//            dataType: "html", //Return data type (what we expect).
            datatype: 'json',
            //This is the function which will be called if ajax call is successful.
            success: function (data) {
                //data is the html of the page where the request is made.


                $('#Cartinfo').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#error').html(jqXHR.status);

            }
        });
}
</script>
