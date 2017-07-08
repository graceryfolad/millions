<!--get categories-->
<div class="panel">
    <div class="heading">
        <span class="title">New Service</span>
    </div>
    
    <div class="content padding20">
        <form method="post" action="<?php echo site_url('Service/add');?>">
              
        <table class="" style="width: 50%">
            <tr>
                <td>Service Code</td>
                <td><input type="text" name="scode" class="input-control text" /></td>
            </tr>
            <tr>
                <td>Service Name</td>
                <td><input type="text" name="sname" class="input-control text" /></td>
            </tr>
            <tr>
                <td>Service Category</td>
                <td>
                    <select class="input-control select" name="cat">
                        <?php
                        if(isset($cats) && count($cats) > 0){
                            foreach ($cats as $value) {
                                echo "<option value=\"{$value['cat_id']}\">{$value['cat_name']}</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>API Code</td>
                <td><input type="text" name="apicode" class="input-control text" /></td>
            </tr>
            <tr>
                <td>API Commission</td>
                <td><input type="text" name="apicomm" class="input-control text" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="btnsubmit" class="button success large" /></td>
            </tr>
        </table>
            
        </form>
    </div>
</div>