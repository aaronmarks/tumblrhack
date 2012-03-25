var post_index = 0;
var post_type = "";

document.observe('keydown', function(e){
    if(e.keyCode == 37) { prev_post(); }
    if(e.keyCode == 39) { next_post(); }
});

function initialize_type(type) {
    post_type = type;
    for (var i=0; i<posts.length; i++) {
        if (posts[i]['type'] == post_type) {
            var author = "<a href='http://" + posts[i]['author'] + ".tumblr.com'>"+posts[i]['author']+"</a><hr />";
            $('posts').innerHTML = "via " + author + "<br /><br />" + posts[i]['content'];
            post_index = i;
            break;
        }
    }
}

function prev_post() {
    for (var i=post_index-1; i>0; i--) {
        if (posts[i]['type'] == post_type) {
            var author = "<a href='http://" + posts[i]['author'] + ".tumblr.com'>"+posts[i]['author']+"</a><hr />";
            $('posts').innerHTML = "via " + author + "<br /><br />" + posts[i]['content'];
            post_index = i;
            break;
        }
    }
}

function next_post() {
    for (var i=post_index+1; i<posts.length; i++) {
        if (posts[i]['type'] == post_type) {
            var author = "<a href='http://" + posts[i]['author'] + ".tumblr.com'>"+posts[i]['author']+"</a><hr />";
            $('posts').innerHTML = "via " + author + "<br /><br />" + posts[i]['content'];
            post_index = i;
            break;
        }
    }
}

function set_logo(text){
    $('logo').innerHTML=text;
}
