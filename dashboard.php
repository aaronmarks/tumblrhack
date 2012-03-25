<?php
require_once('tumblroauth/tumblroauth/tumblroauth.php');
require_once('tumblroauth/config.php');
include 'utils.php';
$post_xml = load_post_xml();
$posts = post_array_from_xml($post_xml);
?>
<html>
<head>
    <title>Dashboard</title>
    <link rel='stylesheet' type='text/css' href='styles/dashboard.css' />
    <script src='scriptaculous-js-1.9.0/lib/prototype.js'></script>
    <script src='dashboard.js'></script>
    <script>
    var posts = new Array();
        var i = 0;
        <?php
        foreach($posts as $post) { ?> 
            posts[i] = new Array;
            posts[i]["type"] = "<?php echo $post['type']; ?>"; 
            posts[i]["content"] = "<?php echo $post['content']; ?>";
            i = i+1;
        <?php } ?>
    </script>
</head>
<div id='type_selectors'>
<ul>
    <li><a href="#" onclick="initialize_type('regular');">Text</a></li>
    <li><a href="#" onclick="initialize_type('photo');">Photo</a></li>
    <li><a href="#">Video</a></li>
    <li><a href="#">Audio</a></li>
</ul>
</div>

<div id='posts'>
Select a post type from above...
</div>

<div id='post_controls'>
    <a id='left_button' onclick="prev_post();"><---</a>
    <a id='right_button'onclick="next_post();">---></a>
</div>

</html>
