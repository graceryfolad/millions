<!DOCTYPE html>
<html>
    <?php
    if ($header)
        echo $header;
    ?>
    <body class="bg-a">

        <?php $this->load->view("admin/ad-metro-menu") ?>
        <div class="page-content">
            <div class="flex-grid no-responsive-future" style="height: 100%;">
                <div class="row">
                    <?php $this->load->view("admin/adminsidebar") ?>
                    <div class="cell auto-size padding20 bg-white" id="cell-content">
                        <?php
                        if ($body)
                            echo $body;
                        ?>
                    </div>
                </div>
            </div>


        </div>

        
    </div>


    <?php
    if ($footer)
        echo $footer
        ?>

</div>  
</body>
</html>





