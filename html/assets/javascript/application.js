var login_form_animation_timeout;

$(document).ready(function(){
    $('nav li').on('click', nav_click);
    $('#login').on('click', user_login);
    
    $('a[rel=popover]').popover();
    $('.dropdown-toggle').dropdown();
    
    setTimeout(showSocial, 1500);
});

function showSocial() {
    $('#social').show();
}

function nav_click(event) {
    var location = $(this).find('>a').attr('href');
    
    if(location != undefined)
        window.location = location;
}

function user_login(event) {
    event.preventDefault();
    
    // change to loading cursor
    $('html').css('cursor', 'wait');
    
    // hide errors
    $('#login-error').slideUp();
    
    // submit form over ajax
    $.ajax({
        url     : '/auth/login',
        type    : 'POST',
        data    : $('#login_form').serialize(),
        success : handle_login
    });
}

function handle_login(response) {
    $('html').css('cursor', 'auto');
    
    switch(response) {
        case 'migrated':
            display_login_message('This account has been migrated to a Mojang account.  Please use your email address to log in for the first time.');
        break;
        
        case 'OK':
            window.location = window.location;
        break;
        
        case 'locked':
            display_login_message('New user signup has been disabled. Please wait 5 minutes and try again.');
        break;
        
        case 'bad login':
        case 'Bad Input':
        case 'Bad Password':
        default:
            display_login_message('Either your username or password is invalid.  Check that you can login on <a href="http://minecraft.net/login">Minecraft.net</a> before trying again.');
        break;
    }
}

function display_login_message(data) {
    var alert = '<h4>Error!</h4> ' + data;
    $('#login-error').html(alert).slideDown();
}