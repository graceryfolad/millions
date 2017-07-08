<style type="text/css">
    .center-me{
        margin: 0 25%;


        width: 50%;
    }
    .fp{
        color: red;
    }
</style> 
<div class="padding40 bg-white">
    <div class="center-me" >
        <h1 class="align-center fg-blue">New Membership</h1>
        <div id="one">
            <div id="error"></div>
            <div class="input-control text full-size">
                <label>Enter your MA Username </label><br /><input type="text" name="username" id="username" required/>

            </div> 
            <br/><br/>
            <input type="button" class="button primary" value="Verify Username" name="submit" onclick="VerifyUsername()"/>
        </div>
        <div id="regform"></div>
    </div>

</div>

<script>

    function VerifyUsername()
    {
        var usn = $('#username').val();

        if(usn.length > 0){

        var postdata = {
            'username': usn
        };

        $.ajax({
            url: "<?php echo site_url('/Home/VerifyUsername'); ?>", //The url where the server req would we made.

            type: "POST", //The type which you want to use: GET/POST
            data: postdata, //The variables which are going.
//            dataType: "html", //Return data type (what we expect).
            datatype: 'json',
            //This is the function which will be called if ajax call is successful.
            success: function (data) {
                //data is the html of the page where the request is made.
//                console.log(data);
                $('#one').hide();
                $('#regform').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#error').html(jqXHR.status);

            }
        });
        
        }
        else{
            $('#error').html("<p>Please enter your username</p>");
        }
        

    }

</script>