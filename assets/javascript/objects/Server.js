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
var Server = (function() {
    function Server(json, fullStatus) {
        //defaults
        if(fullStatus === undefined) {
            fullStatus = false;
        }
        
        // assimilate
        for(attr in json) {
            this[attr] = json[attr];
        }
        
        this.fullStatus = fullStatus;
        
        // display data from ajax call
        this.loadStatus = function(status) {
            var str = '';
            for(item in status) {
                this[item] = status[item];
            }
            
            $this = $('#server-' + this.id);
            
            if($this.size() == 1) {
                $this.find('.online-info').html(this.onlineInfo());
                
                if(this.fullStatus) {
                    this.displayInfo();
                    init_iso_views();
                }
            }
        }
        
        this.getStatus();
    }
    
    return Server;
})();

Server.prototype.getStatus = function() {
    $.ajax({
        url : '/server_query',
        dataType : 'json',
        data : {
            server : this.name,
            filters : this.getFilters(),
            realtime : true
        },
        context : this,
        success: this.loadStatus
    });
}

Server.prototype.votedClass = function() {
    if(this.voted) {
        return 'voted';
    } else {
        return '';
    }
}

Server.prototype.toString = function() {
    var str =   '<section id="server-' + this.id + '">' +
                    '<div class="quick-info">' +
                        '<div class="online-info">' +
                            this.onlineInfo() +
                        '</div>' + 
                        '<hr>' +
                        '<div class="vote-info">';
                        if($('#user-logged-in').size() == 1) {
                            str += '<i class="icon-arrow-up up_vote ' + this.votedClass() + '" data-id="' + this.id + '"></i> ';
                        } else {
                            str += '&nbsp;&nbsp;&nbsp;';
                        }
                        str +=
                            '<span class="votes">' +
                                this.votes +
                            '</span> ' +
                            '<span class="small-text">votes</span>' +
                        '</div>' +
                    '</div>' +
                    '<div class="details">' +
                        '<div class="name">' +
                            '<a href="' + this.page_link + '">' +
                                this.name +
                            '</a>' +
                        '</div>' +
                        '<div class="info">' +
                            this.address;
                            if(this.port != '25565')
                            {
                                str += ':' + this.port;
                            }
                        str +=
                        '</div>' +
                        '<hr />' +
                        '<div class="description">' +
                            this.description +
                        '</div>' +
                    '</div>' +
                '</section>';
    
    return str;
}

Server.prototype.onlineInfo = function() {
    var str = '';
        if('Online' in this) {
            if(this.Online) {
                str +=
                '<span class="badge badge-success">' +
                    '<i class="icon-ok icon-white"></i>' +
                '</span>';
            } else {
                str +=
                '<span class="badge badge-important">' +
                    '<i class="icon-remove icon-white"></i>' +
                '</span>';
            }
        } else {
            str +=
            '<span class="badge">' +
                '?' +
            '</span>';
        }
        
        str += this.getPlayerCounts();
    
    return str;
}

Server.prototype.getPlayerCounts = function() {
    var str = '<span class="players">';
    
    if('Players' in this) {
        str += this.Players;
    } else {
        str += '?';
    }
    
    str += ' / ';
    
    if('MaxPlayers' in this) {
        str += this.MaxPlayers;
    } else {
        str += '??';
    }
    
    return str;
}

Server.prototype.getFilters = function() {
    if(this.fullStatus){
        return '';
    } else {
        return 'Players,Online,MaxPlayers';
    }
}

Server.prototype.displayInfo = function() {
    for(key in this) {
        var before = '';
        var text = this[key];
        
        switch(key) {
            case 'HostName':
                before = '- ';
                $('#' + key).removeClass('loading');
            break;
            
            case 'GameType':
                switch(this[key]) {
                    case 'SMP':
                        text = "Survival Multiplayer";
                    break;
                    
                    case 'CMP':
                        text = "Creative Multiplayer";
                    break;
                    
                    case 'HMP':
                        text = "Hardcore Multiplayer";
                    break;
                    
                    case 'AMP':
                        text = "Adventure Multiplayer";
                    break;
                }
            break;
            
            case 'PlayerList':
                text = '';
                if(this[key].length > 0) {
                    for(player in this[key]) {
                        text += '<tr>' +
                                    '<td>' +
                                        '<div class="media">' +
                                            '<a class="pull-left" href="#">' +
                                                '<div class="minecraft_head" data-size="5" data-minecrafthead="/game/get_skin/' + this[key][player] +  '">' +
                                                '</div>' +
                                            '</a>' +
                                            '<div class="media-body">' +
                                                '<h4 class="media-heading"><a href="/user/' + this[key][player] + '">' + this[key][player] + '</a></h4>' +
                                            '</div>' +
                                        '</div>' +
                                    '</td>' +
                                '</tr>';
                    }
                } else {
                    text = '<tr>' +
                                '<td>No players are online.</td>' +
                            '</tr>';
                }
            break;
            
            case 'Online':
                var badge = $('#online-badge');
                var tr = $('#Online').parent();
                
                badge.removeClass('badge-success').removeClass('badge-important');
                tr.removeClass('success').removeClass('error');
                
                if(this[key]) {
                    text = "Online";
                    badge.addClass('badge-success').html('<i class="icon-ok icon-white"></i>');
                    tr.addClass('success');
                } else {
                    text = "Offline";
                    badge.addClass('badge-important').html('<i class="icon-remove icon-white"></i>');
                    tr.addClass('error');
                    
                    if($('#owner-actions').size() == 1) {
                        $('div[id^="server-"] .navbar').after('<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    'If your server is online, but not showing up as such, make sure' +
                                    ' you have set enable-query=true in your server config file.' +
                                    '</div>');
                    }
                }
            break;
            
            case 'Players':
                text = "Players " +
                        '<span class="light">' +
                            this[key] + ' / ' + this['Max' + key] +
                        '</span>';
            break;
            
            case 'Plugins':
                text = '';
                for(plugin in this[key]) {
                    text += '<tr><td>' +
                                this[key][plugin] +
                            '</td></tr>';
                }
            break;
        }
        
        $('#' + key).html(before + text);
    }
    
    $('.loading').removeClass('loading');
}