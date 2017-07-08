<div class="panel">
    <div class="heading">
        <span class="title">Merchant Services</span>
    </div>
    <div class="content padding20">
        <div class="accordion" data-role="accordion">
            <div class="frame">
                <div class="heading">Create New Merchant Service</div>
                <div class="content">
                    <div id="addinfo"></div>
                    <table>
                        <tr>
                            <td style="width: 200px;"> <b>Name</b></td>
                            <td><input type="text" id="sername" class="input-control text" value="" placeholder="Service Name" required="required"></td>
                        </tr>
                        <tr>
                            <td><b> Description</b></td>
                            <td><input type="text" id="serdesc" class="input-control text" placeholder="Service Description" required="required"/></td>

                        </tr>
                        <tr>
                            <td> <b>Percentage</b></td>
                            <td><input type="text" id="serper" class="input-control text" placeholder="Service Percentage" required="required" value="5"/></td>

                        </tr>
                        <tr>
                            <td><b>Minimum Amount</b></td>
                            <td><input type="text" id="seramt" class="input-control text" placeholder="Minimun Amount" required="required" value="0"/></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="button" class="button success" onclick="CreateService()">Submit</button></td>

                        </tr>
                    </table>
                </div>
            </div>
            <div class="frame">
                <div class="heading">List of Merchant Service</div>
                <div class="content">
                    <div id="services"></div>
                </div>
            </div>

        </div>


    </div>
</div>

<script>

    function CreateService()
    {
        var s_name = $('#sername').val();
        var s_desc = $('#serdesc').val();
        var s_per = $('#serper').val();
        var s_amt = $('#seramt').val();


        var postdata = {
            'sname': s_name,
            'sdesc': s_desc,
            'sper': s_per,
            'samt': s_amt,
        };

        $.ajax({
            url: "<?php echo site_url('/Loy_Services/add_service'); ?>", //The url where the server req would we made.

            type: "POST", //The type which you want to use: GET/POST
            data: postdata, //The variables which are going.
//            dataType: "html", //Return data type (what we expect).
            datatype: 'json',
            //This is the function which will be called if ajax call is successful.
            success: function (data) {
                //data is the html of the page where the request is made.


                $('#addinfo').html(data);
                setTimeout(function () {
                    
                    $('#addinfo').remove();
                   LoadServices();
                }, 4000);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#addinfo').html(jqXHR.status);

            }
        });

    }

function LoadServices()
{
      $.ajax({
            url: "<?php echo site_url('/Loy_Services/mer_service'); ?>", //The url where the server req would we made.

            type: "GET", //The type which you want to use: GET/POST
            
//            dataType: "html", //Return data type (what we expect).
            datatype: 'json',
            //This is the function which will be called if ajax call is successful.
            success: function (data) {
                //data is the html of the page where the request is made.


                $('#services').html(data);
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#services').html(jqXHR.status);

            }
        });

}


</script>