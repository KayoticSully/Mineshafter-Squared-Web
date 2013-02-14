
var submenuOffset = 0;

$(document).ready(function(){
    $('#post_track').announcements();
    $('#download_track').loadAndCache();
    
    submenuOffset = $('#submenu').offset();
    
    $(document).scroll(function(){
        var submenu = $('#submenu');
        var scroll = parseInt($('body').scrollTop()) + 40;
        
        if(scroll >= submenuOffset.top) {
            submenu.addClass('navbar-fixed-top').removeClass('navbar-static-top');
        } else if(scroll < submenuOffset.top) {
            submenu.addClass('navbar-static-top').removeClass('navbar-fixed-top');
        }
    });
});