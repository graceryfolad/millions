<div class="cell size-x200" id="cell-sidebar" style="background-color: #71b1d1; height: 100%">
    <ul class="sidebar">
        <li>
            <a href="<?php echo site_url('/Admin/Packages'); ?>">
                <span class="mif-stack2 icon"></span>
                <span class="title">Packages</span>

            </a>

        </li>
        <li>
            <a href="<?php echo site_url('/Admin/Vendors'); ?>">
                <span class="mif-users icon"></span>
                <span class="title">Vendors</span>

            </a>

        </li>
        <li><a href="<?php echo site_url('/Admin/Transactions'); ?>">
                <span class="mif-chart-bars icon"></span>
                <span class="title">Transactions</span>

            </a>
        </li>
        
        <li><a href="<?php echo site_url('/Reversal'); ?>">
                <span class="mif-redo icon"></span>
                <span class="title">Reversals</span>

            </a>
        </li>
        <li>
            <a href="<?php echo site_url('/Admin/Services'); ?>">
                <span class="mif-local-service icon"></span>
                <span class="title">Services</span>

            </a>
        </li>
        <li><a href="<?php echo site_url('/Admin/Bundles'); ?>">
                <span class="mif-vpn-publ icon"></span>
                <span class="title">Data Bundles</span>

            </a></li>
        <li><a href="<?php echo site_url('/Topup_wallet'); ?>">
                <span class="mif-vpn-publ icon"></span>
                <span class="title">Top Up</span>

            </a></li>
        <li><a href="<?php echo site_url('/Admin/Reports'); ?>">
                <span class="mif-history icon"></span>
                <span class="title">Reports</span>
                <span class="counter">2</span>
            </a>
        </li>
        <li>
            <a class="dropdown-toggle" href="#"><span class="mif-local-service icon"></span>E-Pins</a>
            <ul class="d-menu stick bg-green" data-role="dropdown">
                <li><a href="<?php echo site_url('/EPins/index'); ?>"><span class="mif-phone-in-talk icon"></span> Pin Batches</a></li>
                <li><a href="<?php echo site_url('/Generate_Epin/index'); ?>"><span class="mif-phone-in-talk icon"></span> Generate Pins</a></li>
                <li><a href="<?php echo site_url('/EPins/requestpin'); ?>"><span class="mif-phone-in-talk icon"></span> E-Pins Request</a></li>
                <li><a href="<?php echo site_url('/Denominations/index'); ?>"><span class="mif-display icon"></span>Denominations</a></li>
                
            </ul>
        </li>
        <li>
            <a class="dropdown-toggle" href="#"><span class="mif-local-service icon"></span>Loyalty Program</a>
            <ul class="d-menu stick bg-green" data-role="dropdown">
                <li><a href="<?php echo site_url('/Loyalty/AllMerchants'); ?>"><span class="mif-phone-in-talk icon"></span> Merchants</a></li>
                <li><a href="<?php echo site_url('/Loyalty/Purchases'); ?>"><span class="mif-display icon"></span>Purchases</a></li>
                <li><a href="<?php echo site_url('/Loyalty/Incentives'); ?>"><span class="mif-power icon" ></span>Incentives</a></li>
                <li><a href="<?php echo site_url('/Loyalty/Reports'); ?>"><span class="mif-school icon"></span>Purchases Report</a></li>
            </ul>
        </li>

        
        <li>
            <a class="dropdown-toggle" href="#"><span class="mif-local-service icon"></span>Esusu Contributions</a>
            <ul class="d-menu stick bg-green" data-role="dropdown">
                <li><a href="<?php echo site_url('/EsusuGroup/index'); ?>"><span class="mif-phone-in-talk icon"></span> Esusu Overview</a></li>
                <li><a href="<?php echo site_url('/EsusuGroup/Purchases'); ?>"><span class="mif-display icon"></span>Purchases</a></li>
                <li><a href="<?php echo site_url('/Loyalty/Incentives'); ?>"><span class="mif-power icon" ></span>Incentives</a></li>
                <li><a href="<?php echo site_url('/Loyalty/Reports'); ?>"><span class="mif-school icon"></span>Purchases Report</a></li>
            </ul>
        </li>
    </ul>
</div>