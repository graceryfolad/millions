<div class="panel">
    <div class="heading">
        <span class="title">Esusu Contribution</span>
    </div>

    <div class="content padding20">
        <div class="">
            <a href="<?php echo site_url('EsusuGroup/Newgroup');?>">New Group</a>
        </div>
        <table class="table border bordered">
            <tr>
                <td>S/N</td>
                
                <td>Group Name</td>
                <td>Amount</td>
                <td>Status</td>
                <td>Details</td>
                
                
               
            </tr>
            <?php
            if (isset($esgroups)) {
                $counter =1;
                foreach ($esgroups as $value) {
                    ?>
                    <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $value['es_grp_name']; ?></td>
                        <td><?php 
                        echo $value['es_grp_amount']
                        ?></td>
                        <td><?php 
                      if($value['es_grp_status'] == GROUP_OPEN){
                          echo "Opened";
                      }
                      elseif($value['es_grp_status'] == GROUP_CLOSE){
                          echo "Closed";
                      }
                      elseif($value['es_grp_status'] == GROUP_RUNNING){
                          echo 'Running';
                      }
                        ?></td>
                        <td><a href="<?php echo site_url("EsusuGroup/GroupDetails/{$value['es_grp_id']}"); ?>">View Details</a></td>
                    </tr>
                    <?php
                    $counter++;
                }
            }
            ?>

        </table>
    </div>
</div>

