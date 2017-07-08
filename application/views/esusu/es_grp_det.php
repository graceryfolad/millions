<div class="panel">
    <div class="heading">
        <span class="title">Group Details </span>
    </div>

    <div class="content padding10">

        <?php
        if (isset($grpdet)) {
            ?>
            <table class="table" style="width: 60%;">
                <tr>
                    <td class="" style="width: 30%;">Group Name</td>
                    <td class="" style="width: 70%;"><?php echo $grpdet['es_grp_name']; ?></td>
                </tr>
                <tr>
                    <td class="">Group Amount</td>
                    <td class=""><?php echo $grpdet['es_grp_amount']; ?></td>
                </tr>
                <tr>
                    <td class="">Total Member</td>
                    <td class=""><?php echo $grpdet['es_grp_total']; ?></td>
                </tr>
                <tr>
                    <td class="">Group Frequency</td>
                    <td class=""><?php
                        if ($grpdet['es_grp_freq'] == FREQ_DAILY) {
                            echo "Daily";
                        } elseif ($grpdet['es_grp_freq'] == FREQ_WEEKLY) {
                            echo "Weekly";
                        } elseif ($grpdet['es_grp_freq'] == FREQ_MONTHLY) {
                            echo "Monthly";
                        }
                        ?></td>
                </tr>
                <tr>
                    <td class="">Group Leader</td>
                    <td class=""><?php echo $grpdet['us_name']; ?></td>
                </tr>
            </table>
            <?php
        }

        if (isset($members)) {
            ?>
            <table class="table" style="width: 50%;">
                <tr>
                    <td>SN</td>
                    <td>Member Name</td>
                    <td>Collection Position</td>
                </tr>
                <?php
                $counter = 1;
                foreach ($members as $value) {
                    ?>
                    <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $value['us_name']; ?></td>
                        <td><?php echo $value['coll_position']; ?></td>
                    </tr>
                    <?php
                    $counter++;
                }
                ?>
            </table>
            <?php
        }

        if (isset($caninvite) ) {
            
            ?>
        <form method="post" action="<?php echo site_url('Contribution/InviteMember');?>">
            <input type="hidden" name="grpid"  value="<?php echo $grpdet['es_grp_id'];?>" required="required"/>
            <p><label>Enter Username</label><input type="text" name="username"  /> <button>Send Invitation</button></p>
        </form>
            <?php
        }
        ?>
        
        <h3>List of Invitations</h3>
        <ol>
            
       
        <?php
        
        if(isset($allinvites)){
            foreach ($allinvites as $value) {
                echo "<li>{$value['us_name']}</li>";
            }
        }
        ?>
             </ol>
    </div>
</div>

