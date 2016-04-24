<?php

    // Update timestamp
    if(isset($_GET['password'])){
        $success = false;
        $password = file_get_contents('../private/password.txt');
        $password = trim($password);
        if($_GET['password'] == $password){

            $interval = isset($_GET['interval']) ? $_GET['interval'] : 5;
            $timeout = 10;
            $timeout = ($interval >= $timeout) ? $interval + 1 : $timeout;

            if(isset($_GET['offline']) && $_GET['offline'] == "1"){
                $dateToWrite = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." -2 minutes"));
                $expires_on = false;
            }else{
                $dateToWrite = date('Y-m-d H:i:s');
                $expires_on = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." +{$timeout} minutes"));
            }

            file_put_contents('../private/last_updated.txt', $dateToWrite);
            $success = true;
        }
        http_response_code(($success) ? 200 : 400);
        header('Content-type: application/json');
        echo json_encode(array(
            'success' => $success,
            'expires_on' => $expires_on
        ));
        exit();
    }

    print_r($_GET);
    // Fetch timestamp
    $last_updated = file_get_contents('../private/last_updated.txt');

    // Last update within 10 minutes?
    $status = (strtotime($last_updated) > strtotime("-10 minutes") ? 'online' : 'offline');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta http-equiv="refresh" content="60" />

        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="theme-color" content="#<?php echo (($status == 'online') ? 'dff0d8' : 'f2dede' );?>">

        <title>
            <?php if($status == 'online'):?>
                Yeah &#128077;, Kingsley is online!
            <?php else: ?>
                No &#128078;, Kingsley is offline!
            <?php endif; ?>
        </title>

        <?php if($status == 'online'):?>
            <link rel='shortcut icon' type='image/x-icon' href='/thumb-up.ico' />
        <?php else:?>
            <link rel='shortcut icon' type='image/x-icon' href='/thumb-down.ico' />
        <?php endif;?>


        <meta content="Is Kingsley Online?" property="og:title" />
        <meta content="website" property="og:type" />
        <meta content="Don't know if Kingsley is online? Find out here" property="og:description" />
        <meta content="http://iskingsley.online" property="og:url" />
        <meta content="/preview-image.png" property="og:image" />

        <meta content="summary_large_image" name="twitter:card" />
        <meta content="Is Kingsley Online?" name="twitter:title" />
        <meta content="Don't know if Kingsley is online? Find out here" name="twitter:description" />
        <meta content="/preview-image.png" name="twitter:image" />
        <meta content="http://iskingsley.online" name="twitter:url" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

        <!--[if lt IE 9]>
            <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style>
            html,body, .status {
                height: 100%;
            }
            body.kingsley--is-online{
                background-color:#dff0d8;
            }
            body.kingsley--is-offline{
                background-color: #f2dede;
            }
            .status{
                display: -ms-flexbox;
                display: -webkit-flex;
                display: flex;
                -ms-flex-align: center;
                -webkit-align-items: center;
                -webkit-box-align: center;.
                align-items: center;
                justify-content: center;
                height: 100%;
                font-size: 10em;
                font-weight: bold;
            }
            .fork-on-github{
                position: absolute;
                top: 0;
                border: 0;
                right: 0;
            }
            .fork-on-github a {
                display: block
            }
            .fork-on-github a:hover {
                text-decoration: none
            }
            .fork-on-github a:hover .octo-arm {
                animation: octocat-wave 560ms ease-in-out
            }
            .fork-on-github a .octo-arm,
            .fork-on-github a .octo-body{
                fill: #<?php echo (($status == 'online') ? 'dff0d8' : 'f2dede' );?>;
            }
            @media (max-width: 500px) {
                .fork-on-github a:hover .octo-arm {
                    animation:none
                }
            }
            .fork-on-github a:hover::before {
                height: 0;
                visibility: hidden
            }
            @keyframes octocat-wave {
                0%,100% {
                    transform: rotate(0)
                }
                20%,60% {
                    transform: rotate(-25deg)
                }
                40%,80% {
                    transform: rotate(10deg)
                }
            }
        </style>

        <script>
            !function(I,s,O,n,l,y,N){I.GoogleAnalyticsObject=O;I[O]||(I[O]=function(){
            (I[O].q=I[O].q||[]).push(arguments)});I[O].l=+new Date;y=s.createElement(n);
            N=s.getElementsByTagName(n)[0];y.src=l;N.parentNode.insertBefore(y,N)}
            (window,document,'ga','script','//www.google-analytics.com/analytics.js');

            ga('create', 'UA-21583989-3', 'auto');
            ga('send', 'pageview');
        </script>
    </head>
    <body id="app" class="kingsley--is-<?php echo $status;?>">
        <main role="main" class="status">
            <?php if($status == 'online'){
                echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }else{
                echo '<i class="fa fa-thumbs-down" aria-hidden="true"></i>';
            }?>
        </main>

        <div class="fork-on-github">
            <a href="https://github.com/kingsloi/iskingsley.online" target="_blank"><svg width="80" height="80" viewBox="0 0 250 250" style="fill:#333; color:#fff;"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a>
        </div>
    </body>
</html>