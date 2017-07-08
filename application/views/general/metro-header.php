<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="keywords" content="Utility Warehouse, Airtime, Recharge, MillionsAchievers, DSTV, Paybills, Startime">
    <meta name="author" content="Utility Warehouse">

    <link rel='shortcut icon' type='image/x-icon' href='../favicon.ico' />

    <title> Millions Achievers: buy airtime, make payments, send money and recieve money with your ATM card</title>

    

    <link href="<?php echo base_url("metro/css/metro.css"); ?>" rel="stylesheet" />
    <link href="<?php echo base_url("metro/css/metro-icons.css"); ?>" rel="stylesheet" />
    <link href="<?php echo base_url("metro/css/metro-responsive.css"); ?>" rel="stylesheet" />
    <link href="<?php echo base_url("metro/css/metro-schemes.css"); ?>" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url("metro/css/docs.css"); ?>" rel="stylesheet" type="text/css"/>
    
    
    

    <style>
        html, body {
            height: 100%;
        }
        body {
        }
        .page-content {
            padding-top: 3.125rem;
            min-height: 100%;
            height: 100%;
        }
        .table .input-control.checkbox {
            line-height: 1;
            min-height: 0;
            height: auto;
        }

        @media screen and (max-width: 800px){
            #cell-sidebar {
                flex-basis: 52px;
            }
            #cell-content {
                flex-basis: calc(100% - 52px);
            }
        }
    </style>

    <script>
        function pushMessage(t){
            var mes = 'Info|Implement independently';
            $.Notify({
                caption: mes.split("|")[0],
                content: mes.split("|")[1],
                type: t
            });
        }

        $(function(){
            $('.sidebar').on('click', 'li', function(){
                if (!$(this).hasClass('active')) {
                    $('.sidebar li').removeClass('active');
                    $(this).addClass('active');
                }
            })
        })
    </script>

</head>