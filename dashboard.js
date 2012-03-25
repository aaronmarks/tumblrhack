var post_index = 0;
var post_type = "";

function initialize_type(type) {
    post_type = type;
    for (var i=0; i<posts.length; i++) {
        if (posts[i]['type'] == post_type) {
            $('posts').innerHTML = posts[i]['content'];
            post_index = i;
            break;
        }
    }
}

function update_posts(type, index){
    $('posts').innerHTML = post.content;
}

function prev_post() {
    for (var i=post_index-1; i>0; i--) {
        if (posts[i]['type'] == post_type) {
            $('posts').innerHTML = posts[i]['content'];
            post_index = i;
            break;
        }
    }
}

function next_post() {
    for (var i=post_index+1; i<posts.length; i++) {
        if (posts[i]['type'] == post_type) {
            $('posts').innerHTML = posts[i]['content'];
            post_index = i;
            break;
        }
    }
}
