<div class="panel">
    <div class="heading">
        <span class="title">Pins Purchased</span>
    </div>

    <div class="content padding20">

       
        
        
        <div class="table-responsive">
            <table class="table border bordered">
                <tr>
                    <td>S/N</td>
                    <td>Pin Value</td>
                    <td>Pin Serial</td>
                    <td>Pin Number</td>
                    <td>Pin Purchase Date</td>
                    <td>Pin Usage</td>
                </tr>
                <?php
                    if(isset($ppurchases))
                    {
                        $counter = 1;
                        foreach ($ppurchases as $value) {
                            ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $value['pin_value'] ;?></td>
                    <td><?php echo $value['pin_serial'] ;?></td>
                    <td><?php echo $value['pin_number'] ;?></td>
                    <td><?php echo $value['pur_date'] ;?></td>
                    <td><?php 
                    if($value['pin_used'] ==1)
                        {
                            echo "<span class=\"button danger\">Used</span>";
                        }
                        else{
                            
                            echo "<span class=\"button success\">Not Used</span>";
                            ?>
                        <form method="post" action="<?php echo site_url('EPins/LoadPin');?>">
                            <input type="hidden" name="pvalue" value="<?php echo $value['pin_value']?>" />
                            <input type="hidden" name="pid" value="<?php echo $value['pin_id']?>" />
                            <button type="submit">Load Pin</button>
                        </form>
                        <?php
                        }
                    ?>
                        
                    </td>
                </tr>
                <?php
                $counter++;
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</div>