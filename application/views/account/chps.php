<div class="panel">
    <div class="heading">
        <span class="title">Change Password</span>
    </div>
    <div class="content">
        <div class="padding10">
            
            <?php
            if(isset($status)){
              
                echo "$status";
            }
            
            ?>
            <br/>
            <br/>
            <form action="<?php echo site_url('/Account/ChangePS'); ?>" method="post">
                <div class="input-control text">
                    <label for="exampleInputEmail1">Old Password</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Enter your old password" name="oldps" required="required">
                </div>
                <br />
                <br />
                <div class="input-control text">
                    <label for="exampleInputEmail1">New Password</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Enter your New password" name="newps" required="required">
                </div>
                <br />
                <br />
                <div class="input-control text">
                    <label for="exampleInputEmail1">Retype Password</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Retype new password" name="retype" required="required">
                </div>
                <br />
                <br />
                <div class="input-control text">
                   
                    <input type="submit" class="button info" id="exampleInputEmail1" name="changeps" required="required">
                </div>
                
            </form>
        </div>
    </div>
</div>