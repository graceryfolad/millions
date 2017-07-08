
<div class="content padding20">
    <?php
    if (isset($services) && count($services)) {
        foreach ($services as $value) {
            ?>
            <a href="<?php echo site_url("/Vendor/Smile/{$value['ser_code']}"); ?>">
                <div class="tile bg-cyan fg-white " data-role="tile">
                    <div class="tile-content iconic">
                        <span class="icon mif-phone"></span>

                        <span class="tile-label center"><?php echo $value['ser_name'] ?></span>
                    </div>
                </div>
            </a>
            <?php
        }
    }
    ?>
    


</div>




<script>
    function GetPin() {


        var num = $("#pincount").val();
        if ($.isNumeric(num)) {
            var amount = num * 700;
            $("#amount").val(amount);
        }



    }

</script>
