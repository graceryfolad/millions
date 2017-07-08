<!DOCTYPE html>
<html>
<?php
if ($header)
    echo $header;
?>
    <body style="background-image: url(<?php echo base_url('Tools/images/bg1.JPG');?>); ">
    <div class="container">
        <?php $this->load->view("general/navigation_metro") ?>
        <div class="flex-grid">
            <?php
        
        if ($body)
            echo $body;
        ?>
        </div>
        
        
        <?php
        if ($footer)
            echo $footer
        ?>
       
    </div>  
</body>
</html>





