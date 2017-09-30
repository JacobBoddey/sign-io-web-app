<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/util.php';
session_start();

$config = [];

$request = new \Zend\Http\PhpEnvironment\Request();
$ad = new \Magium\ActiveDirectory\ActiveDirectory(
    new \Magium\Configuration\Config\Repository\ArrayConfigurationRepository($config),
    Zend\Psr7Bridge\Psr7ServerRequest::fromZend(new \Zend\Http\PhpEnvironment\Request())
);

$entity = $ad->authenticate();

?>

<head>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<meta name="viewport" content="width=device-width" />
	<meta name="theme-color" content="#008A5F" />
	<meta name="msapplication-navbutton-color" content="#008A5F">
	<meta name="apple-mobile-web-app-status-bar-style" content="#008A5F">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title>Chellaston Academy</title>
	<link rel="icon" type="image/png" href="/img/favicon.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="../instascan.min.js"></script>
</head>

<body>

	<ul class="navigation-bar">
		<li class="active"><a href="index.php"><img width=30px src="../img/left-arrow.png"></img></a></li>
		<li class="navigation-text">QR Scanner</li>
	</ul>
	
	<video id="qr-scan" style="width:100%;transform:scaleX(1);">
	
	<script type="text/javascript">
	
      let scanner = new Instascan.Scanner({ video: document.getElementById('qr-scan') });
      scanner.addListener('scan', function (content) {
        window.location = "scan-result.php?code=" + content;
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 1) {
          scanner.start(cameras[1]);
        } 
		else if (cameras.length > 0) {
			scanner.start(cameras[0]);
		}
		else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
	  
	  let ops = {
		  continuous: true,
		  video: document.getElementById('qr-scan'),
		  mirror: false,
		  backgroundScan: false,
		  refractoryPeriod: 5000,
		  scanPeriod: 1
	  };
	  
    </script>
		
</body>