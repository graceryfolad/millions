<div class="panel">
    <div class="heading">
        <span class="title">Account Verification</span>
    </div>
    <div class="content">
        <div class="verify">
        <?php
            if(isset($verify)){
                
                $cat = $verify['cat'];
                switch ($cat){
                    case 2:
                         $this->load->view('vendor/tv_verify');
                        break;
                   
                    case 3:
                    $this->load->view('vendor/ele_verify',$verify);
                        break;
                    
                }
            }
 else {
     echo "<p class=\"bg-red margin10\">Account could not be verified</p>";
 }
        ?>
</div>
    </div>
</div>


