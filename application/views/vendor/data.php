
    <div class="panel">
        <div class="heading">
            <span class="title">Buy Data Subscription</span>
            
        </div><!-- /.box-header -->
        <!-- form start -->
        
        <div class="content padding20">
            <?php
        echo form_open('/Order/add', array('class' => ""));
        ?>
            <div class="input-control select">
                <label for="exampleInputPassword1"> Select Mobile Network</label>
                <select class="" name="network" id="code" onChange="GetBundle(this.value)">
                <option value="">Select a Network</option>
                    <?php
                        if(isset($services)){
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
                <label for="">Mobile Number</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone" name="order_for" required="required">
            </div>
            <br />
            <br />
            <div class="input-control text">
                <select class="" name="amount" id="bundle">

                </select>
                <p id="error"></p>
            </div>

            <br />
            <br />
        <input type="hidden" name="cat" value="4" />
        <div class="box-footer">
            <input type="submit" class="button info" name="SubmitOrder" value="Place Order" />
        </div>
        </form>
        </div><!-- /.box-body -->
        
    </div><!-- /.box -->

    <script>

    function GetBundle(val)
    {
        

        

        var postdata = {
            'ser_code': val,
            


        };

        $.ajax({
            url: "<?php echo site_url('/DataBundle/GetBundle'); ?>", //The url where the server req would we made.

            type: "POST", //The type which you want to use: GET/POST
            data: postdata, //The variables which are going.
//            dataType: "html", //Return data type (what we expect).
            datatype: 'json',
            //This is the function which will be called if ajax call is successful.
            success: function (data) {
                //data is the html of the page where the request is made.


                $('#bundle').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#error').html(jqXHR.status);

            }
        });

    }

</script>

