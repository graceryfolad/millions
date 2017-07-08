<div class="panel">
    <div class="heading">
        <span class="title">E-Pins</span>
    </div>
    <div class="content padding20">

        <h3 class="sub-header">Create Batch Numbers</h3>
        <form action="<?php echo site_url('/EPins/NewBatch'); ?>" method="post">
            <label>Total Batch Number</label>&nbsp;<input type="text" name="bnum" placeholder="Batch Number Total" class="input-control text" /><br/>
            
           
            <button class="button success" name="pack">Generate Now</button>   
        </form>


        <hr />
        <table class="table border bordered">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Batch Code</th>
                    <th>Batch Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($batches)) {
                    $counter=1;
                    foreach ($batches as $value) {
                        ?>
                        <tr>
                            <td><?php echo $counter;?></td>
                            <td><?php echo $value['bat_code'];?></td>
                            <td><?php 
                            if($value['bat_status']==BATCH_ACTIVE){
                                echo "<button class=\"button info\">ACTIVE</button>";
                            }
                            if($value['bat_status']==BATCH_USED){
                                echo "<button class=\"button success\">USED</button>";
                            }
                            if($value['bat_status']==BATCH_INACTIVE){
                                echo "<button class=\"button danger\">INACTIVE</button>";
                            }
                            ?></td>
                        </tr>
                        <?php
                        $counter++;
                    }
                } else {
                    echo "No Batch was found";
                }
                ?>
            </tbody>
        </table>

    </div>
</div>