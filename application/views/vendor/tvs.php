
    <div class="panel">
        <div class="heading">
        <span class="title">Digital TV Subscription</span>
            
        </div><!-- /.box-header -->
        <!-- form start -->
        
        <div class="content padding20">
        <?php
        echo form_open('/Order/Verify', array('class' => ""));
        ?>
            <div class="input-control select">
                <label for="exampleInputPassword1"> <b>Select Digital TV Subscription</b></label>
                <select class="" name="network">
                   
                    <?php
                        if(isset($services)){
                            foreach ($services as $value) {
                                echo "<option value=\"{$value['ser_code']}\">{$value['ser_name']}</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <br/>
            <br/>
            <div class="input-control text">
                <label for="exampleInputEmail1"><b>Decoder Number</b></label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Smartcard Number " name="order_for" required="required">
            </div>
             <br/>
            <br/>
            <div class="input-control text">
                <label for="exampleInputPassword1"><b> Recharge Amount</b></label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Amount" name="amount" required="required">
            </div>
             <br/>
            <br/>
            <input type="hidden" name="cat" value="2" />
        <div class="box-footer">
            <input type="submit" class="button info" name="SubmitVerify" value="Verify Account" />
        </div>
        </form>
        </div><!-- /.box-body -->

        
    </div><!-- /.box -->
    
    

