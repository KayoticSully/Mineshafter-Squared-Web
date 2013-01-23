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
    }
    
    return str;
}