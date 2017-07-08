<div class="panel">
    <div class="heading">
        <span class="title">Esusu Contribution</span>
    </div>

    <div class="content padding20">
        <h3>Kindly select your position</h3>
        <?php
        if (isset($members)) {
            $keep = array();
            if (isset($grpdet)) {
                $keep = array();
                for ($j = 1; $j <= $grpdet['es_grp_total']; $j++) {
                    $keep[] = $j;
                }
                for ($j = 0; $j < $grpdet['es_grp_total']; $j++) {
                    ?>
                    <form method="post" action="<?php echo site_url('Contribution/AddPosition'); ?>">
                        <input type="hidden" name="grpid" value="<?php echo $grpdet['es_grp_id']; ?>"/>
                        <input type="hidden" name="myposition" value="<?php $keep[$j]; ?>"/>
                        <?php
                        foreach ($members as $value) {
                            if ($value['coll_position'] == $j) {
                                unset($keep[$j]);
                                echo "<button class=\"button danger large \" disabled>  Position {$j}</button> <br/>";
                            }
//                            else {
//                                echo "<button class=\"button success large \">  Position {$j}</button>";
//                            }
                        }
                        ?>


                    </form>
                    <br/>
                    <?php
                }
            }
            print_r($keep);
            foreach ($keep as $value) {
                
            
                ?>
                <form method="post" action="<?php echo site_url('Contribution/AddPosition'); ?>">
                    <input type="hidden" name="grpid" value="<?php echo $grpdet['es_grp_id']; ?>"/>
                    <input type="hidden" name="myposition" value="<?php echo $value ?>"/>
                    <button class="button success large ">  Position <?php echo $value; ?></button>


                </form>
                <?php
            }
        }
        ?>
    </div>
</div>



