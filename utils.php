<?php
function query($query) {
    $username = tumblr;
    $password = hackny2012isgreat;

    mysql_connect("localhost", $username, $password) or die(mysql_error());
    mysql_select_db("tumblr") or die(mysql_error());
    $result = mysql_query($query);
    $row = mysql_fetch_array( $result );
    mysql_close();

    return $row;
}
?>
