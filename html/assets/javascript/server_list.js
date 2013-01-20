var serverList = null;
var serverCap = false;

$(document).ready(init);

function init() {
    serverList = new ServerList();
    
    $('.editable').on('focusin', clearText);
    $('.editable').on('focusout', restoreText);
    $('#create-server').on('click', addServer);
    $(window).on('scroll', pageScroll);
    $(window).scroll();
}

function clearText() {
    var $this = $(this);
    var content = $this.data('default');
    console.log('focusin');
    if(content == undefined || content == '') {
        var text = $this.html();
        $this.data('default', text);
        $this.html(' ');
    }
}

function restoreText() {
    var $this = $(this);
    var content = $this.html().trim();
    
    if(content == '&nbsp;' || content == '') {
        var text = $this.data('default');
        $this.html(text);
        $this.data('default', '');
    }
}

function addServer() {
    $('#serverlist-error').fadeOut();
    
    $('html').css('cursor', 'wait');
    
    $.ajax({
        url : '/server_list/add_new_server',
        data : $('#server-form').serialize(),
        success : handleAddServerResponse
    });
}

function handleAddServerResponse(data) {
    $('html').css('cursor', 'auto');
    
    if(data != 'OK') {
        var alert = '<h4>Error!</h4> ' + data;
        $('#serverlist-error').html(alert).slideDown();
    } else {
        var name = $('#server-form #name').val();
        window.location = '/server/' + name.trim().split(' ').join('_');
    }
}

function loadServers(offset) {
    
    if(offset === undefined) {
        offset = 0;
    }
    
    $.ajax({
        url : '/server_list/json/' + offset,
        dataType: 'json',
        success: renderServers
    });
}

function renderServers(serverArray) {
    var newServers = new ServerList();
    
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

function pageScroll(event) {
    var $window = $(window);
    var scrollTop = $window.scrollTop();
    var windowHeight = $window.height();
    var documentHeight = $(document).height();
    
    if(scrollTop + windowHeight >= documentHeight && $('.server_list_load').size() == 0 && !serverCap) {
        
        var loading = '<div class="server_list_load remove">' +
                        '&nbsp;' +
                    '</div>';
                    
        $('#server-list').append(loading);
        
        var offset = 0;
        if(serverList != null) {
            offset = serverList.size();
        }
        
        loadServers(offset);
    }
}

function handle_vote() {
    var $this = $(this);
    var operation = 'up_vote';
    
    if($this.hasClass('voted')) {
        operation = 'remove_vote';
    }
    
    $.ajax({
        url : '/server_list/' + operation + '/' + $this.data('id'),
        context : $this,
        success : function(success) {
            if(success.trim() == 'true') {
                var $this = $(this)
                var $votes = $this.parent().find('.votes');
                
                var num = parseInt($votes.html());
                
                if($this.hasClass('voted')) {
                    num = num - 1;
                } else {
                    num = num + 1;
                }
                
                $votes.html(num);
                $this.toggleClass('voted');
            }
        }
    });
}