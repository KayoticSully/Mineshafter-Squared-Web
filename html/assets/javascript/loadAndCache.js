/*
 |---------------------------------------------------------------------
 | Load And Cache
 |---------------------------------------------------------------------
 | Manages and controls when to load html from the server
 |---------------------------------------------------------------------
 | Author(s): Ryan Sullivan
 |   Created: 8/23/2012
 |   Updated: 8/24/2012
 |  Location: ./assets/javascript/announcements.js
 */

(function( $ ){
    
    var time        = new Date().getTime();
    var timeLimit   = 86400000 * 7;
    
    /*-------------------------------------------
     * "Plugin Constructor"
     *-------------------------------------------
     * Controls the settings of the plugin interface
     * of itsself.
     */
    $.fn.loadAndCache = function(options){
        
        var settings = $.extend( {
            
        }, options);
        
        return this.each(function()
        {
            var href    = $(this).data('href');
            var cache   = localStorage.getItem(href);
            var timeout = localStorage.getItem(href + '-timeout');
            
            if(cache == null || (time - timeout > timeLimit))
            {
                $.ajax({
                    url: href,
                    dataType: 'html',
                    context: this,
                    success: ajaxLoad
                });
            }
            else
            {
                loadHTML($(this), cache);
            }
        });
    };
    
    function ajaxLoad(html) {
        // get it out to screen asap
        loadHTML($(this), html);
        
        // now lets cache it
        var href = $(this).data('href');
        localStorage.setItem(href, html);
        localStorage.setItem(href + '-timeout', time);
    }
    
    function loadHTML(element, html) {
        element.html(html);
    }
})( jQuery );