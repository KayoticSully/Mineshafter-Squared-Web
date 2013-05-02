var serverList = null;

$(document).ready(init);

function init() {
    serverList = new ObjectList();
    init3d();
    renderServers(servers);
}

function renderServers(serverArray) {
    var newServers = new ObjectList();
    
    for(index in serverArray)
    {
        var server = new Server(serverArray[index]);
        newServers.add(server);
    }
    
    var html = '';
    if(newServers.size() > 0) {
        html = newServers.toString();
    } else {
        serverCap = true;
        html = '<div class="center medium strong remove">You\'ve reached the end!</div>';
    }
    
    $('.server_list_load').replaceWith(html);
    
    $('.up_vote').off('click').on('click', handle_vote);
    serverList.add(newServers);
}