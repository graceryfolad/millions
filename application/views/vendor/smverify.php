<div class="panel">
    <div class="heading">
        <span class="title">Smile Verification</span>
    </div>
    <div class="content padding20">
        <form method="post" action="<?php echo site_url('/Order/add');?>">
        <?php
        if(isset($smverify)){
            $name = $smverify['fn'] . "".$smverify['ln'];
            
            echo "<p>Customer Name <strong>{$name}</strong></p>";
        }
        if (isset($bundles)) {
            ?>
        <br/>
        <div class="input-control select">
            <label for="">Select Bundle</label>
            <select name="amount">
                <?php
                foreach ($bundles as $value) {
                    $amt = "{$value->amount},{$value->typeCode}";
                    echo "<option value=\"{$amt}\">{$value->description}</option>";
                }
                ?>
            </select>
            <input type='hidden' name='smtype' value='1' />
            
        </div>
        <br/>
        <br/>
            <?php
        } else {
            echo "<div class=\"input-control text \">";
             echo "<label>Enter Amount</label>";
            echo "<input type='text' name='amount' />";
            echo "<input type='hidden' name='smtype' value='2' />";
            echo "</div>";
        }
        ?>
        <br/>
        <br/>
         <input type='hidden' name='cat' value="7" />
         <input type='hidden' name='network' value="<?php echo $network; ?>" />
         <input type='hidden' name='order_for' value="<?php echo $custnum; ?>" />
         <button type="submit" class="button success large">Confirm Order</button>
    </form>
    </div>
</div>