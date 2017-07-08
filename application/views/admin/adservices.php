<div class="panel">
    <div class="heading">
        <span class="title"> Services</span>
    </div>
    <div class="content padding20">

        <div class="list">
            <a href="<?php echo site_url('/Admin/Services/1'); ?>">New Service</a>
            <?php
            
            if (isset($aservice)) {
               ?>
             <form method="post" action="<?php echo site_url("Service/edit");?>">
              
        <table class="" style="width: 50%">
            
            <input type="hidden" name="scode" class="input-control text" value="<?php echo $aservice['ser_code'] ;?>" />
            
            <tr>
                <td>Service Name</td>
                <td><input type="text" name="sname" class="input-control text" value="<?php echo $aservice['ser_name'] ;?>"/></td>
            </tr>
            
            <tr>
                <td>API Code</td>
                <td><input type="text" name="apicode" class="input-control text" value="<?php echo $aservice['api_code'] ;?>"/></td>
            </tr>
            <tr>
                <td>API Commission</td>
                <td><input type="text" name="apicomm" class="input-control text" value="<?php echo $aservice['api_comm'] ;?>" /></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="status" class="input-control select" >
                        <option value="0" <?php if($aservice['ser_status'] ==0) echo "selected"; ?>>Disabled</option>
                        <option value="1" <?php if($aservice['ser_status'] ==1) echo "selected"; ?>>Enabled</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="btnsubmit" class="button success large" /></td>
            </tr>
        </table>
            
        </form>
            <?php
                
            }
            elseif (isset($services)) {
              ?>  
            <h3>List of Services</h3>
            <table class="table border">
                <thead>
                    <tr>
                        <td>Service Name</td>
                        <td>Service Code</td>
                        <td>Service Status</td>
                        <td>Edit</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        if (count($services) > 0) {
                            foreach ($services as $row) {
                               
                                if($row['ser_status']==0){
                                   $status =  "<button class=\"button danger\"> Suspended</button>";
                                }
                                else{
                                   $status =  "<button class=\"button success\"> Active</button>";
                                }
                                ?>
                                <tr>
                                    <td><?php echo $row['ser_name']; ?></td>
                                    <td><?php echo $row['ser_code']; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td><a href="<?php echo site_url("/Admin/Services/{$row['ser_code']}"); ?>"> Edit Service</a></td>
                                </tr>
                                <?php
                            }
                        }
                    
                    ?>
                </tbody>
            </table>
<?php
            }
?>
        </div>
    </div>
</div>