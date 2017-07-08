 <div class="app-bar fixed-top navy" data-role="appbar">
     <a class="app-bar-element">
         <img src="<?php echo base_url('/Tools/images/moryield.jpeg');?>" height="10px" width="50px" />
            <b>Moryield Int'l Ltd</b>
     </a>
        <span class="app-bar-divider"></span>
        <ul class="app-bar-menu">
            <li><a href="<?php echo site_url('/Vendor');?>">Dashboard</a></li>
            <li><a href="<?php echo site_url('/Vendor/Ticket');?>">Ticket</a></li>
            <li><a href="#">Wallet Balance 
                    <?php echo $balance; ?>
                </a>
            </li>
            
            
        </ul>

        <div class="app-bar-element place-right">
            <span class="dropdown-toggle"><span class="mif-cog"></span> <?php echo strtoupper($uinfo['name']); ?></span>
            <div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow fg-dark" data-role="dropdown" data-no-close="true" style="width: 220px">
                
                <ul class="unstyled-list fg-white1 bg-active-dark">
                    <li><a href="<?php echo site_url('/Profile');?>" class="fg-white fg-hover-yellow">Profile</a></li>
                    <li><a href="<?php echo site_url('/Account');?>" class="fg-white fg-hover-yellow">Change Password</a></li>
                    <li><a href="<?php echo site_url('/Account/LogOut');?>" class="fg-white fg-hover-yellow">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>