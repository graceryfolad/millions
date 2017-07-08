<div class="panel">
    <div class="heading">
        <span class="title">Education</span>
    </div>
    <div class="content padding20">
        <h3>WAEC PINS</h3>
        <form action="<?php echo site_url('/Order/add'); ?>" method="post">
            <div class="input-control text">
                <label for="pincount"><b>Number of Pins</b></label>
                <input type="text" class="form-control" id="pincount" placeholder="Pins" name="order_for" required="required" onchange="GetPin()">
            </div>
            <br />
            <br />
            <div class="input-control text">
                <label for="amount"><b>Amount to Pay</b></label>
                <input type="text" class="form-control" id="amount" placeholder="0" name="amount" required="required">
            </div>
            <div id="rex"></div>
                
            <br />
            <br />
            <input type="hidden"  name="network" value="<?php echo $scode;?>" />
            <input type="hidden"  name="cat" value="<?php echo $cat;?>" />
            <div class="input-control">
               
                <input type="submit" class="button info" name="SubmitOrder" value="Place Order" />
            </div>
        </form>
    </div>
</div>

<script>
   function GetPin(){
   
        
    var num = $("#pincount").val();
    if($.isNumeric(num)){
        var amount = num * 700;
         $("#amount").val(amount);
    }
       
   
    
}

</script>
 