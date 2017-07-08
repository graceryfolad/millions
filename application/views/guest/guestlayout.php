<!DOCTYPE html>
<html>
<?php
if ($header)
    echo $header;
?>
<body>
    <div class="container">
        <?php $this->load->view("general/navigation") ?>
        
        <?php
        
        if ($body)
            echo $body;
        ?>
        
        <?php
        if ($footer)
            echo $footer
        ?>
       
    </div>  
</body>
</html>





