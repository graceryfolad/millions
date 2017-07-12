<div class="panel">
    <div class="heading">
        <span class="title">Your Bank Details</span>
    </div>

    <div class="content padding20">
        <div class="">
            <form action="<?php echo site_url('Contribution/');?>" method="post">
                <table class="table" style="width: 50%;">
                    <tr>
                        <td>Account Name</td>
                        <td>
                            <div class="input-control text">
                                <input type="text" name="acctname" placeholder="Enter Account Name" class="form-control" required="required"/>
                            </div>
                            
                        </td>
                    </tr>
                     <tr>
                        <td>Bank Name</td>
                        <td>
                            <div class="input-control text">
                                <input type="text" name="bankname" placeholder="Enter Bank Name" required="required"/>
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <td>Account Number</td>
                        <td>
                            <div class="input-control text">
                                <input type="text" name="acctnum" placeholder="Enter Account number" required="required"/>
                            </div>
                        </td>
                    </tr>
                     
                     <tr>
                        <td></td>
                        <td><button class="button medium success" type="submit">Submit</button></td>
                    </tr>
                </table>
                
            </form>
        </div>
      
    </div>
</div>
