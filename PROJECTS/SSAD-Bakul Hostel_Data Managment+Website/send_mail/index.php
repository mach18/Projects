<?php
include('menu.php');
echo "<br /><br />";
echo "<br />";
?>
<html>
<head>

<title>
Address Book
</title>
<!DOCTYPE html>


<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="generator" content="Wufoo">
<meta name="robots" content="index, follow">

<!-- CSS -->
<link href="menu.css" rel="stylesheet">
<link href="css/structure.css" rel="stylesheet">
<link href="css/form.css" rel="stylesheet">

<!-- JavaScript -->
<script src="scripts/wufoo.js"></script>

<!--[if lt IE 10]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body id="public">
<div id="container" class="ltr">

<!--<h1 id="logo">
<a href="http://wufoo.com" title="Powered by Wufoo">Wufoo</a>
</h1>
-->
<form id="form16" name="form16" class="wufoo  page" autocomplete="off" enctype="multipart/form-data" method="post" novalidate
action="send_mail.php">
<header id="header" class="info">
<h2>Send Mail To Admin</h2>
<div></div>
</header>

<ul>

<li id="foli0" class="name notranslate">
<label class="desc" id="title0" for="Field0">
Subject
</label>
<!--/li>

<li-->
<span>
<textarea name="subject" rows="1" cols="55">
</textarea>
</span>
</li>

<li id="foli0" class="name notranslate">
<label class="desc" id="title0" for="Field0">
Body
</label>
<!--/li>

<li-->
<span>
<textarea name="body" rows="8" cols="55">
</textarea>
</span>
</li> 

<li class="buttons ">
	<input id="saveForm" name="saveForm" class="btTxt submit" type="submit" value="Send" />
</li>
</div>
</ul>
</form> 
</div>
<!--container-->

</body>
</html>
