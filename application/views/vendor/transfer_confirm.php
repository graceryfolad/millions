<?php

if(isset($udet)){
  ?>
<p><b>Vendor Name : <?php echo $udet['us_name']; ?></b></p>
<p><b>Transfer Amount : <?php echo $udet['amount']; ?></b></p>
<?php
echo $form = form_open("/Wallet/Topup");
echo form_hidden('vendor', $udet['us_id']);

echo form_hidden('famt', $udet['amount']);

$data = array(
    'id' => 'button',
    'class' => 'button info'
);

//echo form_button($data);
echo form_submit('SubmitTransfer', 'Confirm Transfer', $data);
echo form_close();
}
else{
    ?>
<p class="danger text">No Record found </p>
<?php
}
?>