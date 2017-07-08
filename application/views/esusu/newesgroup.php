<div class="panel">
    <div class="heading">
        <span class="title">New Esusu Group</span>
    </div>

    <div class="content padding20">
        <div class="">
            <form action="<?php echo site_url('Contribution/prcNewGroup');?>" method="post">
                <table class="table" style="width: 50%;">
                    <tr>
                        <td>Group Name</td>
                        <td>
                            <div class="input-control text">
                                <input type="text" name="grpname" placeholder="Enter group Name" class="form-control" required="required"/>
                            </div>
                            
                        </td>
                    </tr>
                     <tr>
                        <td>Group Amount</td>
                        <td>
                            <div class="input-control text">
                                <input type="text" name="grpamt" placeholder="Enter group amount" required="required"/>
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <td>Frequency</td>
                        <td>
                            <div class="input-control select">
                                <select name="grpfreq">
                                    <option value="<?php echo FREQ_DAILY; ?>">Daily</option>
                                <option value="<?php echo FREQ_WEEKLY; ?>">Weekly</option>
                                <option value="<?php echo FREQ_MONTHLY; ?>">Monthly</option>
                            </select>
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <td>Total Member</td>
                        <td><div class="input-control select">
                            <select name="grptotal">
                                <option>5</option>
                                <option>10</option>
                                <option>15</option>
                                <option>20</option>
                                <option>25</option>
                            </select>
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <td></td>
                        <td><button class="button medium success" type="submit">Create Group</button></td>
                    </tr>
                </table>
                
            </form>
        </div>
      
    </div>
</div>
