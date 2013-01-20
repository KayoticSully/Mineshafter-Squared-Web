/*
 |---------------------------------------------------------------------
 | Server
 |---------------------------------------------------------------------
 | Represents a server
 |---------------------------------------------------------------------
 | Author(s): Ryan Sullivan
 |   Created: 1/18/2013
 |   Updated: 1/18/2013
 |---------------------------------------------------------------------
 */
var server_count = 0;

var ServerList = (function() {
    function ServerList() {
        this.servers = new Array();
        
        this.add = function(server) {
            if(server instanceof ServerList) {
                this.servers = this.servers.concat(server.servers);
            } else if(server instanceof Server) {
                this.servers.push(server);
            }
        }
        
        this.size = function() {
            return this.servers.length;
        }
    }
    
    return ServerList;
})();

ServerList.prototype.toString = function() {
    var str = '';
    for(server in this.servers) {
        str += this.servers[server];
        server_count++;
        
        if(server_count % 4 == 0) {
            str += this.getAd();
        }
    }
    
    return str;
}

ServerList.prototype.getAd = function() {
    var str = '<script type="text/javascript"><!--' +
                'google_ad_client = "ca-pub-2130540909688027";' +
                '/* Server List */' +
                'google_ad_slot = "3737500637";' +
                'google_ad_width = 728;' +
                'google_ad_height = 90;' +
                '//-->' +
            '</script>' +
            '<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>';
    return '<div class="listAd">' + str + '</div>';
}