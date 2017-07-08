<?php
if(isset($memdet)){
    
    ?>
<table class="table border bordered" style="width: 50%;">
    <tr>
        <td>Name</td>
        <td><?php echo $memdet['us_name']?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $memdet['us_email']?></td>
    </tr>
    <tr>
        <td>Phone Number</td>
        <td><?php echo $memdet['us_phone']?></td>
    </tr>
    
</table>

<a href="<?php echo site_url("Purchase/member_add/{$memdet['us_id']}"); ?>" class="button success large">Add Purchases</a>
<?php
   
}