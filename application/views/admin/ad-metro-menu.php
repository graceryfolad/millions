 <div class="app-bar fixed-top darcula" data-role="appbar">
        <a class="app-bar-element branding">MA Recharge</a>
        <span class="app-bar-divider"></span>
        <ul class="app-bar-menu">
            <li><a href="<?php echo site_url('/Admin');?>">Home</a></li>
            
            
            
        </ul>

        <div class="app-bar-element place-right">
            <span class="dropdown-toggle"><span class="mif-cog"></span> <?php echo $uinfo['name']; ?></span>
            <div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow fg-dark" data-role="dropdown" data-no-close="true" style="width: 220px">
                
                <ul class="unstyled-list fg-dark">
                    <li><a href="<?php echo site_url('/Profile');?>" class="fg-white1 fg-hover-yellow">Profile</a></li>
                    <li><a href="<?php echo site_url('/Account');?>" class="fg-white2 fg-hover-yellow">Change Password</a></li>
                    <li><a href="<?php echo site_url('/Account/LogOut');?>" class="fg-white3 fg-hover-yellow">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>