<div class="panel">
    <div class="heading">
        <div class="title">Merchants</div>
    </div>
    <div class="content padding20">
        <?php
        


        echo form_open('/Merchant/New_Merchant', array('class' => ""));
        ?>

        <div class="input-control text full-size">
            <label> Name of Merchant</label>
            
            <input type="text" name="mname" class="form-control" placeholder="Merchant Name" required="required" id="fullname" value="<?php if(isset($matrix) && is_array($matrix)){echo $matrix['name'];}?>"/>
        </div>
        <br/>
        <br/>
        <div class="input-control text full-size">
            <input type="text" name="maddress" class="form-control" placeholder="Office Address" required="required" id="email"  value="<?php if(isset($matrix) && is_array($matrix)){echo $matrix['email'];}?>"/>
        </div>
        <br/>
        <br/>
        <div class="input-control text full-size">
            <input type="email" name="memail" class="form-control" placeholder="Contact Email Address" required="required" id="email"  value="<?php if(isset($matrix) && is_array($matrix)){echo $matrix['email'];}?>"/>
        </div>
        <br/>
        <br/>
        <div class="input-control text full-size">
            <input type="text" name="mphone" class="form-control" placeholder="Contact Phone Number" required="required" id="phone"  value="<?php if(isset($matrix) && is_array($matrix)){echo $matrix['phone'];}?>"/>
        </div>
        <br/>
        <br/>
        <div class="input-control textarea full-size">
            <textarea name="mdesc">Enter description of merchant here</textarea>
        </div>
        <br/>
        <br/>
        


        <input type="submit" class="button primary" value="Add Merchant" name="submit"/>

        

        </form>
    </div>
</div>
