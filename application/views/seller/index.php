<div class="panel">
    <div class="heading">
        <span class="title">Dashboard</span>
    </div>
    <div class="content padding20">
        <div class="verify">
            <label>Enter Member Username</label><br/><br/>
            <input type="text" id="phone" />
            <button type="button" onclick="VerifyUser()">Verify User</button>
            
            <hr/>
            
            
        </div>
        <div id="memdet"></div>
        <div class="list">
            <h3>List of Transactions by Merchant</h3>
        </div>
    </div>
</div>

   <script>

    function VerifyUser()
    {
        
var phone = $('#phone').val();
        

        var postdata = {
            'phone': phone,
            


        };

        $.ajax({
            url: "<?php echo site_url('/Seller/VerifybyPhone'); ?>", //The url where the server req would we made.

            type: "POST", //The type which you want to use: GET/POST
            data: postdata, //The variables which are going.
//            dataType: "html", //Return data type (what we expect).
            datatype: 'json',
            //This is the function which will be called if ajax call is successful.
            success: function (data) {
                //data is the html of the page where the request is made.


                $('#memdet').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#memdet').html(jqXHR.status);

            }
        });

    }

</script>