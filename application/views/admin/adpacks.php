<div class="panel">
    <div class="heading">
        <span class="title">Packages</span>
    </div>
    <div class="content padding20">
        <div class="padding10">
            <h3 class="sub-header">Create New Vendor Package</h3>
            <form action="<?php echo site_url('/Package/add'); ?>" method="post">
                <label>Vendor Package Name</label><input type="text" name="pkname" placeholder="Package Name" />
                <button class="button info" name="pack">Save</button>   
            </form>
        </div>

        <hr />

        <div class="padding20">
            <h3 class="sub-header">List of Vendor Packages</h3>
            <table class="dataTable border bordered" data-role="datatable" data-auto-width="true">
                <thead>
                    <tr>
                        <td>Package Name</td>
                        <td>Package Details</td>
                    </tr>
                </thead>
                <?php
                if (isset($packs) && count($packs) > 0) {
                    foreach ($packs as $value) {
                        ?>
                        <tr>
                            <td><?php echo $value['pack_name'];?></td>
                            <td><a href="<?php echo site_url("/Admin/Packages/{$value['pack_id']}"); ?>">Configure</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>


</div>