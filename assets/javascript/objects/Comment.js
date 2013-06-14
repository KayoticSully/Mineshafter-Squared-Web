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

var Comment = (function() {
    function Comment(data) {
        // load the topic into this object
        for(var attr in data)
        {
            this[attr] = data.topic[attr];
        }
    }
    
    return Comment;
})();

Comment.prototype.toString = function(){
    var str = '<div class="media comment">' +
                '<a class="pull-left" href="#">' +
                    '<img class="media-object" src="http://placehold.it/64x64&text=">' +
                '</a>' +
                '<div class="media-body">' +
                    '<h4 class="media-heading">' +
                        'Username' +
                    '</h4>' +
                    this.content +
                '</div>' +
            '</div>';
    return str;
}