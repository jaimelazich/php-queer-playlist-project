
<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>

	<div class="header">

		<div class="wrapper">

			<ul class="nav">
                <li class="qpp<?php if ($section == "qpp") { echo " on"; } ?>"><a href="index.php">QPP</a></li>
                <li class="qpp<?php if ($section == "playlist") { echo " on"; } ?>"><a href="playlist.php">Playlist</a></li>
                <li class="qpp<?php if ($section == "suggest") { echo " on"; } ?>"><a href="suggest.php">Suggest</a></li>
            </ul>

		</div>

	</div>

	<div id="content">