/*
 |---------------------------------------------------------------------
 | Topic
 |---------------------------------------------------------------------
 | Represents a forum Topic
 |---------------------------------------------------------------------
 | Author(s): Ryan Sullivan
 |   Created: 2/16/2013
 |   Updated: 2/16/2013
 |---------------------------------------------------------------------
 */

var Topic = (function() {
    
    function Topic(data) {
        this.posts = new ObjectList();
        this.titlePost = data.post;
        
        // load the topic into this object
        for(var attr in data.topic)
        {
            this[attr] = data.topic[attr];
        }
    }
    
    return Topic;
})();

Topic.prototype.getPosts = function(index, offset) {
    // set defaults
    if(index == undefined) index = 0;
    if(offset == undefined) offset = 2;
}

Topic.prototype.toString = function() {
    var str = '<article id="' + this.id + '" class="topic">' +
                '<div class="media title-post">' +
                    '<a class="pull-left" href="#">' +
                        '<img class="media-object" src="http://placehold.it/64x64&text=">' +
                    '</a>' +
                    '<div class="media-body">' +
                        '<h3 class="media-heading">' +
                            this.title +
                        '</h3>' +
                        this.titlePost.content +
                    '</div>' +
                '</div>' +
                '<div class="actions">' +
                    '<div class="show-comments">' +
                        '<i class="icon-comment icon-white" title="older"></i>' +
                        '<span class="underline">Comments (0)</span>' +
                    '</div>' +
                    '<div class="get-older">' +
                        '<i class="icon-time icon-white" title="older"></i>' +
                        '<span class="underline">History (<?php echo $comments - 2; ?>)</span>' +
                    '</div>' +
                '</div>' +
                '<div class="topic-thread">' +
                    '<div class="comments">' +
                        
                    '</div>' +
                '</div>' +
            '</article>';
    return str;
}