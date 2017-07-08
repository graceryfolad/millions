<div class="panel">
    <div class="heading">
        <span class="title">Esusu Contribution</span>
    </div>

    <div class="content padding20">
        <div class="">
            <a href="<?php echo site_url('Contribution/VNewgroup');?>">Create a Group</a>
        </div>
        <table class="table border bordered">
            <tr>
                <td>S/N</td>
                
                <td>Group Name</td>
                <td>Amount</td>
                <td>Status</td>
                <td>Details</td>
                <td>Invitation</td>
                
               
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
                        <td><a href="<?php echo site_url("Contribution/GroupDetails/{$value['es_grp_id']}"); ?>">View Details</a></td>
                        <td>
                            
                        </td>
                    </tr>
                    <?php
                    $counter++;
                }
            }
            
            if(isset($myinvite))
            foreach ($myinvite as $value) {
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
                        <td><a href="<?php echo site_url("Contribution/GroupDetails/{$value['es_grp_id']}"); ?>">View Details</a></td>
                        <td>
                            <?php
                                if(isset($myinvite)){
                                    foreach ($myinvite as $row) {
                                        if($row['es_grp_id'] == $value['es_grp_id']){
                                            ?>
                            <form method="post" action="<?php echo site_url('Contribution/AcceptInvite');?>">
                                <input type="hidden" name="grpid" value="<?php echo $value['es_grp_id'];?>"/>
                                <input type="hidden" name="rep" value="1"/>
                                <button class="button success large"> Accept Invitation</button>
                                
                            </form>
                            
                            <form method="post" action="<?php echo site_url('Contribution/AcceptInvite');?>">
                                <input type="hidden" name="grpid" value="<?php echo $value['es_grp_id'];?>"/>
                                <input type="hidden" name="rep" value="0"/>
                                <button class="button danger large"> Reject Invitation</button>
                                
                            </form>
                            <?php
                                        }
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                    $counter++;
                }
                
            ?>

        </table>
    </div>
</div>



