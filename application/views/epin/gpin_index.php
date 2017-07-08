<div class="panel">
    <div class="heading">
        <span class="title">Generate E-Pin</span>
    </div>
    
    <div class="content padding20">
        
        <form action="<?php echo site_url('/Generate_Epin/getbatch'); ?>" method="post">
           
            
           
            <button class="button success" name="pack">Generate Pins</button>   
        </form>
        
        <table class="table border bordered">
            <tr>
                <td>S/N</td>
                <td>Batch Code</td>
                <td>Number of Pins</td>
                <td>Pin Detail</td>
            </tr>
        <?php
            if(isset($used)){
                $counter =1;
                foreach ($used as $value) {
                    ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <td><?php echo $value['bat_code'];?></td>
                <td>Number of Pins</td>
                <td><a href="<?php echo site_url("Generate_Epin/pin_batch/{$value['bat_code']}"); ?>" class="button info">Details</a></td>
            </tr>
            <?php
                }
            }
            else{
                echo "No Pin has been generated";
            }
        ?>
            
        </table>
        
    </div>
</div>