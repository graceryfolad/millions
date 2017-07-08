<div class="panel">
    <div class="heading">
        <span class="title"></span>
    </div>
    <div class="content padding20">
        <Form action="<?php echo site_url('Vendor/SmileVerify'); ?>" method="post">
        <div class="input-control text">
            <label for="">Smile Account Number</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter account Number" name="acctnum" required="required">
        </div>
        <br/>
        <br/>
        
        
        <div class="input-control select">
            <label for="">Select Type</label>
            <select name="stype">
                <?php
                foreach ($services as $value) {
                    echo "<option value=\"{$value['ser_code']}\">{$value['ser_name']}</option>";
                }
                ?>
            </select>
        </div>
        <br/>
        <br/>
        <button class="button success large" type="submit">Verify Account</button>
        </form>
    </div>
</div>