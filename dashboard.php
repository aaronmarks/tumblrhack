<?php
require_once('tumblroauth/tumblroauth/tumblroauth.php');
require_once('tumblroauth/config.php');
include 'utils.php';
$reg_xml = load_post_xml('regular');
$reg_posts = post_array_from_xml($reg_xml);
$photo_xml = load_post_xml('photo');
$photo_posts = post_array_from_xml($photo_xml);
$video_xml = load_post_xml('video');
$video_posts = post_array_from_xml($video_xml);
?>
<html>
<head>
    <title>Dashbored.</title>
    <link rel='stylesheet' type='text/css' href='styles/dashboard.css' />
    <script src='scriptaculous-js-1.9.0/lib/prototype.js'></script>
    <script src='dashboard.js'></script>
    <script>
    var posts = new Array();
        var i = 0;
        <?php
        foreach($reg_posts as $post) { ?> 
            posts[i] = new Array;
            posts[i]["type"] = "regular"; 
            posts[i]["author"] = "<?php echo $post['author']; ?>"; 
            posts[i]["content"] = "<span class='reg'><?php echo $post['content']; ?></span>";
            i = i+1;
        <?php } ?>
        <?php
        foreach($photo_posts as $post) { ?> 
            posts[i] = new Array;
            posts[i]["type"] = "photo"; 
            posts[i]["author"] = "<?php echo $post['author']; ?>"; 
            posts[i]["content"] = "<?php echo $post['content']; ?>";
            i = i+1;
        <?php } ?>
        <?php
        foreach($video_posts as $post) { ?> 
            posts[i] = new Array;
            posts[i]["type"] = "video"; 
            posts[i]["author"] = "<?php echo $post['author']; ?>"; 
            posts[i]["content"] = "<?php echo $post['content']; ?>";
            i = i+1;
        <?php } ?>
    </script>
</head>
<div id='type_selectors'>
<ul>
    <li id='logo'>Dashbored.&nbsp;&nbsp;&nbsp;&nbsp; </li>
    <li><a href="#" onclick="initialize_type('regular');set_logo('TumblrText');">
        <img onmouseover="$('temp_text').innerHTML='Text';" onmouseout="$('temp_text').innerHTML='Select a post type from above...';" src='images/text_icon.png' /></a></li>
    <li><a href="#" onclick="initialize_type('photo');set_logo('TumblrPics');">
        <img onmouseover="$('temp_text').innerHTML='Photos';" onmouseout="$('temp_text').innerHTML='Select a post type from above...';" src='images/photo_icon.png' /></a></li>
    <li><a href="#" onclick="initialize_type('video');set_logo('TumblrTV&nbsp;&nbsp;');">
        <img onmouseover="$('temp_text').innerHTML='Video';" onmouseout="$('temp_text').innerHTML='Select a post type from above...';" src='images/video_icon.png' /></a></li>
</ul>
</div>

<div id='posts'>
<h2 id='temp_text' style='margin-top:180px;color:gray;' >Select a post type from above...</h2>
</div>

<div id='post_controls'>
    <a id='left_button' onclick="prev_post();"
        onmousedown="highlight('left_button');" onmouseup="un_highlight();">&larr;</a>
    <a id='right_button' onclick="next_post();"
        onmousedown="highlight('right_button');" onmouseup="un_highlight();">&rarr;</a>

</div>

</html>
