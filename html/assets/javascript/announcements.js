/*
 |---------------------------------------------------------------------
 | Announcements
 |---------------------------------------------------------------------
 | Manages posts and controls when to load & fetch more.
 |---------------------------------------------------------------------
 | Author(s): Ryan Sullivan
 |   Created: 8/23/2012
 |   Updated: 8/24/2012
 |  Location: ./assets/javascript/announcements.js
 */

(function( $ ){
    
    var storage     = 'announcements-posts';
    var cacheTime   = 'announcements-cache-time';
    var timeLimit   = 86400000;
    
    /*-------------------------------------------
     * "Plugin Constructor"
     *-------------------------------------------
     * Controls the settings of the plugin interface
     * of itsself.
     */
    $.fn.announcements = function(options){
        
        var settings = $.extend( {
            
        }, options);
        
        return this.each(function()
        {
            // prevent re-executing the constructor
            if($(this).data('announcements')) return;
            
            // create a new object
            var announcements = new Announcements($(this));
            
            // kickoff with defaults
            announcements.retrievePosts();
            
            // store for later use
            $(this).data('announcements', announcements);
        });
    };
    
    /*--------------------------------
     * "Constructor" and Properties
     *--------------------------------
     */
    function Announcements(jObject)
    {
        this.$this = jObject;
        this.blog_posts = new Array();
        
        Object.defineProperty(this, 'posts', {
            get : function(){
                var str = '';
                
                for(var post in this.blog_posts)
                    str += this.blog_posts[post];
                
                return str;
            },
            
            set : function(posts) {
                for(var post in posts)
                    this.addPost(posts[post]);
            }
        });
    }
    
    /*--------------------------------
     * Prototype Functions
     *--------------------------------
     */
    Announcements.prototype = {
        retrievePosts : function(options) {
            var props = $.extend({
                limit: 4,
                offset: 0,
                callback: this.ajaxLoad
            }, options);
            
            var posts   = JSON.parse(localStorage.getItem(storage));
            var timeout = localStorage.getItem(cacheTime);
            var date    = new Date();
            
            if (posts == null || (timeout != null && date.getTime() - timeout > timeLimit))
            {
                $.ajax({
                    url: '/home/announcements/' + props.limit + '/' + props.offset + '/json',
                    dataType: 'json',
                    context: this,
                    success: props.callback
                });
            }
            else
            {
                this.loadAndRender(posts);
            }
        },
        
        ajaxLoad : function(data) {
            this.loadAndRender(data);
            
            var date = new Date();
            localStorage.setItem(storage, JSON.stringify(data));
            localStorage.setItem(cacheTime, date.getTime());
        },
        
        loadAndRender : function(data) {
            this.posts = data;
            this.render();
        },
        
        addPost : function(data)
        {
            var post = new Post(data);
            this.blog_posts.push(post);
        },
        
        render : function(html)
        {
            this.$this.html(this.posts);
        },
        
        /*get posts() {
            var str = '';
            
            for(var post in this.blog_posts)
                str += this.blog_posts[post];
            
            return str;
        },
        
        set posts(data) {
            for(var post in data.response.posts)
                this.addPost(data.response.posts[post]);
        }*/
    }
})( jQuery );