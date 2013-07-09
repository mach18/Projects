<?php
/*
include("../CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"../cas");
phpCAS::setNoCasServerValidation();
phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();
*/?>
<!DOCTYPE html>

<html>
<head>

<title>
Address Book
</title>

<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="generator" content="Wufoo">
<meta name="robots" content="index, follow">

<!-- CSS -->
<link href="css/structure.css" rel="stylesheet">
<link href="css/form.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="menu.css">

<!-- JavaScript -->
<script src="scripts/wufoo.js"></script>

<!--[if lt IE 10]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<?include('menu.php')?>
<br>
<br>
<br>
<body id="public">
<div id="container" class="ltr">

<!--<h1 id="logo">
<a href="http://wufoo.com" title="Powered by Wufoo">Wufoo</a>
</h1>
-->
<form id="form16" name="form16" class="wufoo  page" autocomplete="off" enctype="multipart/form-data" method="post" novalidate
action="user_profile.php">
<header id="header" class="info">
<h2>User's Profile</h2>
<div></div>
</header>

<ul>


<li id="foli0" class="name notranslate      ">
<label class="desc" id="title0" for="Field0">
 Date
</label>
<span>
<input id="Field1" name="start_date" type="text" class="field text fn" value="" size="8" tabindex="1" />
<label for="Field1">Start date(yyyy-mm-dd)</label>
</span>
</li>
<li id="foli0" class="name notranslate      ">
<label class="desc" id="title0" for="Field0">
 Date
</label>
<span>
<input id="Field1" name="finish_date" type="text" class="field text fn" value="" size="8" tabindex="1" />
<label for="Field1">Finish date(yyyy-mm-dd)</label>
</span>
</li>
<li id="foli4" class="complex notranslate      ">
<label class="desc" id="title4" for="Field4">
Description
</label>
<div>
<span class="full addr1">
<input id="Field4" name="description" type="text" class="field text addr" value="" tabindex="7" />
</span>
</li>
<li class="buttons ">
<div>
	<input id="saveForm" name="saveForm" class="btTxt submit" type="submit" value="Update" />
</div>
</li>

</ul>
</form> 

</div>
<!--container-->

<a class="powertiny" href="#"
style="display:block !important;visibility:visible !important;text-indent:0 !important;position:relative !important;height:auto !important;width:95px !important;overflow:visible !important;text-decoration:none;cursor:pointer !important;margin:0 auto !important">
<span style="no-repeat center 7px; margin:0 auto;display:inline-block !important;visibility:visible !important;text-indent:-9000px !important;position:static !important;overflow: auto !important;width:62px !important;height:30px !important">SSAD_group-20</span>
<b style="display:block !important;visibility:visible !important;text-indent:0 !important;position:static !important;height:auto !important;width:auto !important;overflow: auto !important;font-weight:normal;font-size:12px;color:#777;padding:0 0 0 3px;">SSAD_group-20</b>
</a>
</body>
</html>
