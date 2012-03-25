<?php
include 'utils.php';
load_posts();
?>
<html>
<head>
    <title>Dashboard</title>
    <link rel='stylesheet' type='text/css' href='styles/dashboard.css' />
    <script src='dashboard.js'></script>
</head>
<div id='type_selectors'>
<ul>
    <li><a href="#">Text</a></li>
    <li><a href="#">Photo</a></li>
    <li><a href="#">Video</a></li>
    <li><a href="#">Audio</a></li>
</ul>
</div>

<div id='posts'>
</div>

<div id='post_controls'>
    <a id='left_button' onclick="prev_post();"><---</a>
    <a id='right_button'onclick="next_post();">---></a>
</div>

</html>
