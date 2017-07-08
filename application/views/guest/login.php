<style type="text/css">
    .center-me{
        margin: 0 25%;
        
        
        width: 50%;
    }
    .fp{
        color: red;
    }
</style> 
<div class="padding20 bg-white">
    <div class="center-me" >
        
    
    <h1 class="header padding10 center-me fg-blue">Login</h1>
    <?php
    echo form_open('/Process/DoLogin', array('class' => ""));
    ?>
    
        
        <div class="input-control text full-size">
            <input type="email" name="email" placeholder="Email Address" required="required"/>
        </div>
    <br/>
    <br/>
    <div class="input-control password full-size">
            <input type="password" name="password" placeholder="Password" required="required"/>
        </div>
        
    
         <br/>
    <br/>             

    <input type="submit" class="button primary" value="Login" name="submit" />
    <br/>
        <?php
        echo anchor('Home/Register', 'Not a Vendor, Register', 'title="Register Now"');
        
        echo "&nbsp; | &nbsp;";
        echo anchor('Home/Forgot', 'Forgot your password', 'title="Forgot password"');
        ?>
   
</form>

</div>
</div>