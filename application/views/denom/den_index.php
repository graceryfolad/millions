<div class="panel">
    <div class="heading">
        <span class="title">E-Pins Denominations</span>
    </div>
    <div class="content padding20">

        <h3 class="sub-header">Create New Denomination</h3>
        <form action="<?php echo site_url('/Denominations/add'); ?>" method="post">
            <label>Pin Code</label>&nbsp;<input type="text" name="pncode" placeholder="Pin Code" class="input-control text" required="required"/><br/>
            <label>Pin Value</label>&nbsp;<input type="text" name="pnval" placeholder="Pin Value" class="input-control text" required="required"/>
            <br/>
            <button class="button success" name="pack">Save</button>   
        </form>


        <hr />
        <table class="table border bordered">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Pin Code</th>
                    <th>Pin Value</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($pcat)) {
                    $counter=1;
                    foreach ($pcat as $value) {
                        ?>
                        <tr>
                            <td><?php echo $counter;?></td>
                            <td><?php echo $value['pin_code'];?></td>
                            <td><?php echo $value['pin_value'];?></td>
                        </tr>
                        <?php
                        $counter++;
                    }
                } else {
                    echo "No Pin denomination was found";
                }
                ?>
            </tbody>
        </table>

    </div>
</div>