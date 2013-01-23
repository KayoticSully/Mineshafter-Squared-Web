Server Query API
=================

The Server Query API allows any developer to query any Minecraft server for information provided they have **enable-query=true** in their server.properties file.

How to use
-----------
All you need to do is send a get request to and server that is running this project.

Options
-------
*   server - Can either be a url, ip address, or the name of a server if its listed in the server list.
*   port - The port the server is access though (you can leave this blank if the server is using the default port 25565)
*   filters - A comma separated list of fields that you want specifically returned.  This is a good way to only get back a few things and I would ask that you use this feature to save me some bandwidth. Filters are case-sensitive
*   output - How you want your data returned.  The only options right now are json or pre.  Json is the default and just returns a json object.  Pre will return a nice human readable printout.

Examples
---------
*   http://alpha.mineshaftersquared.com/server_query?server=server.mineshaftersquared.com
*   http://alpha.mineshaftersquared.com/server_query?server=KayotiCraft
*   http://alpha.mineshaftersquared.com/server_query?server=KayotiCraft&filters=HostName,Players,PlayerList,Online
*   http://alpha.mineshaftersquared.com/server_query?server=KayotiCraft&filters=HostName,Players,PlayerList,Online&output=pre
*   http://alpha.mineshaftersquared.com/server_query?server=KayotiCraft&output=pre