<div class="panel">
    <div class="heading">
        <span class="title">Pin Request</span>
    </div>
    <div class="content padding20">
        
        <?php
            if(isset($error)){
                echo "$error";
            }
        ?>
        <form action="<?php echo site_url('/EPins/addcart'); ?>" method="post">
            <label>
                Select Denomination
            </label>
            <select name="pcode" class="input-control select">
                <?php
                foreach ($denom as $value) {
                    echo "<option value=\"{$value['pin_code']}\">{$value['pin_value']}</option>";
                }
                ?>
            </select>
            <br/>
            <label>Number of Pins</label>&nbsp;<input type="text" name="pnum" placeholder="Pin Count" class="input-control text"required="required" /><br/>

            <br/>
            <input type="hidden" name="reqid" value="<?php echo $reqid; ?>" />
            <button class="button success" name="pack">Add to Cart</button>   
        </form>





        <h3>Buy Cart Information</h3>
        <table class="table">
            <thead>
                <tr>
                    <td>Pin Value</td>
                    <td>Quantity</td>
                    <td>Amount</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_amt = 0;
                if (isset($reqs) && count($reqs) > 0) {
                    
                    foreach ($reqs as $value) {
                        $amt = $value['pin_value'] * $value['pin_count'];
                        ?>
                        <tr>
                            <td><?php echo $value['pin_value']; ?></td>
                            <td><?php echo $value['pin_count']; ?></td>
                            <td><?php echo $amt ?></td>
                        </tr>
                        <?php
                        
                        $total_amt +=$amt;
                    }
                } else {
                    echo "<b>Request is empty</b>";
                }
                ?>
                        <tr>
                            <td>Grand Total</td>
                            <td>-</td>
                            <td><?php echo $total_amt ?></td>
                        </tr>
            </tbody>
        </table>
        <form method="post" action="<?php echo site_url('EPins/CompleteReq'); ?>">
            <input type="hidden" name="reqid" value="<?php echo $reqid; ?>" />
            <button class="button success" name="pack" type="submit">Complete Request</button>  
        </form> 
    </div>
</div>