/*
 |---------------------------------------------------------------------
 | Post
 |---------------------------------------------------------------------
 | Represents a single Tumblr post
 | along with added functions to provide
 | needed functionality.
 |---------------------------------------------------------------------
 | Author(s): Ryan Sullivan
 |   Created: 8/23/2012
 |   Updated: 8/23/2012
 |  Location: ./assets/javascript/post.js
 */

/*--------------------------------
 * "Constructor"
 *--------------------------------
 * Sets up the object with the
 * attributes of the provided post
 * object.
 */
function Post(tumblr_post)
{
    for(var attr in tumblr_post)
    {
        this[attr] = tumblr_post[attr];
    }
}

/*--------------------------------
 * Prototype Functions
 *--------------------------------
 */
Post.prototype = {
    //--------------------------------
    // toString
    //--------------------------------
    // Constructs the html needed to
    // display the post
    //
    toString : function() {
        var date = new Date(this.date);
        
        return '' +
            '<article>' +
                '<header>' +
                    '<a target="_blank" href="' + this.post_url + '">' +
                        this.title +
                    '</a>' +
                '</header>' +
                '<div class="body">' +
                    this.body +
                '</div>' +
                '<footer>' +
                    date.toLocaleString() +
                '</footer>' +
            '</article>';
    },
    
    json : function() {
        return JSON.stringify(this);
    }
}