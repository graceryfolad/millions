<div class="panel">
    <div class="heading">
        <span class="title">Pin Generation Cart</span>
    </div>
    <div class="content padding20">
        <form action="<?php echo site_url('/Generate_Epin/addcart'); ?>" method="post">
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
            <label>Number of Pins</label>&nbsp;<input type="text" name="pnum" placeholder="Pin Count" class="input-control text" /><br/>

            <br/>
            <input type="hidden" name="batch" value="<?php echo $batch; ?>" />
            <button class="button success" name="pack">Add to Cart</button>   
        </form>

        <h3>Cart Information</h3>
        <table>
            <?php
            if (isset($cart)) {
                foreach ($cart as $value) {
                    ?>
                    <tr>
                        <td><?php echo $value['pin_code']; ?></td>
                        <td><?php echo $value['pin_count']; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>

        </table>
        <form method="post" action="<?php echo site_url('Generate_Epin/generate'); ?>">
            <input type="hidden" name="batch" value="<?php echo $batch; ?>" />
            <button class="button success" name="pack" type="submit">Generate Pins Now</button>  
        </form> 
    </div>
</div>