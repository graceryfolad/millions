<div class="panel">
    <div class="heading">
        <span class="title">Vendor Package Commission</span>
    </div>
    <div class="content">
        <div class="padding10">
            <?php
            if (isset($pinfo)) {
                echo "Package Name : <strong>{$pinfo['pack_name']}</strong>";
            }

            echo form_open('/Pack_commission/add');

            echo form_hidden('pack', $pinfo['pack_id']);
            if (isset($packs_comm)) {
                echo "<table class=\"table\">";
                echo "<tr>";
                echo "<td>Service</td>";
                echo "<td>Commission in Percentage</td>";
                echo "</tr>";
                foreach ($packs_comm as $row) {
                    ?>
                    <tr>
                        <td style="width: 150px;"><?php echo $row['ser_name']; ?></td>
                        <td>
                            <select name="comm_type[]">
                                
                                <option value="1" <?php if($row['is_percent']==1) echo "selected"
                                    ?>
                                        >Percentage</option>
                                <option value="2"  <?php if($row['is_percent']==2) echo "selected"
                                    ?>>Fixed Amount</option>
                            </select>
        <?php
        if($row['is_percent']==2){
            $inp = array(
            'name' => 'comm[]',
            'value' => $row['fixedaoumt'],
            'class' => 'input_form'
        );
        }else{
            $inp = array(
            'name' => 'comm[]',
            'value' => $row['comm_per'],
            'class' => 'input_form'
        );
        }
        
        echo form_input($inp);
        echo form_hidden('ser_code[]', $row['ser_code']);
        ?>
                        </td>
                    </tr>
        <?php
    }
    echo "<tr>";
    echo "<td></td>";
    echo "<td><button type='submit' name='CommSave' class='button info'>Update Commission</button></td>";
    echo "</tr>";
    echo "</table>";
}

echo form_close();
?>


        </div>
    </div>
</div>