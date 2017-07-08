<!DOCTYPE html>
<html>
    <?php
    if ($header)
        echo $header;
    ?>
    <body class="bg-gray">

        <?php $this->load->view("vendor/metro-menu") ?>
        <div class="page-content">
            <div class="flex-grid no-responsive-future" >
                <div class="row">
                    <?php $this->load->view("vendor/vendorsidebar") ?>
                    <div class="cell auto-size padding5" id="cell-content" style="border: 2px sandybrown solid; margin-bottom: 5px; background-color: gray; ">
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





