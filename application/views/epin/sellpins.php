<div class="panel">
    <div class="heading">
        <span class="title">Sell Pins</span>
    </div>

    <div class="content padding20">

        <form method="post" action="<?php  echo site_url('EPins/ProcSell'); ?>"> 
        <div class="input-control select">
            
            <label for="exampleInputPassword1"> <b>Select Pin Value</b></label>
            <select class="" name="pcode">

                <?php
                if (isset($denom)) {
                    foreach ($denom as $value) {
                        echo "<option value=\"{$value['pin_code']}\">{$value['pin_value']}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <br />
        <br />
        <div class="input-control text">
            <label for="exampleInputEmail1"><b>Pin Quantity</b></label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Quantity" name="qty" required="required">
        </div>
        <br />
        <br />
        <div class="input-control text">
            <label for="exampleInputEmail1"><b>Username</b></label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Username" name="username" required="required">
        </div>

        <div class="box-footer">
            <input type="submit" class="button info" name="submit" value="Sell Now" />
        </div>
        </form>
        
        
        <div class="table-responsive">
            <table class="table border bordered">
                <tr>
                    <td>S/N</td>
                    <td>Pin Value</td>
                    <td>Pin Serial</td>
                    <td>Buyer</td>
                    <td>Pin Sold Date</td>
                    <td>Pin Usage</td>
                </tr>
                <?php
                    if(isset($soldpins))
                    {
                        $counter = 1;
                        foreach ($soldpins as $value) {
                            ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $value['pin_value'] ;?></td>
                    <td><?php echo $value['pin_serial'] ;?></td>
                    <td><?php echo $value['us_name'] ;?></td>
                    <td><?php echo $value['pur_date'] ;?></td>
                    <td><?php 
                    if($value['pin_used'] ==1)
                        {
                            echo "<span class=\"button danger\">Used</span>";
                        }
                        else{
                            echo "<span class=\"button success\">Not Used</span>";
                        }
                    ?></td>
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