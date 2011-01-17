var login_form_animation_timeout;

$(document).ready(function(){
    $('nav li').on('click', nav_click);
    $('#login').on('click', user_login);
    
    $('[rel=popover]').popover();
    $('.dropdown-toggle').dropdown();
    
    if(localStorage.getItem('stopit-count') == undefined) {
        localStorage.setItem('stopit-count', 0);
    }
    
    if(localStorage.getItem('stopit-timeout') == undefined) {
        localStorage.setItem('stopit-timeout', 0);
    }
    
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
    
    // get stoppit time
    stopitCount = parseInt(localStorage.getItem('stopit-count'));
    stopitTimeout = new Date(localStorage.getItem('stopit-timeout'));
    
    if(new Date() - stopitTimeout > 600000) {
        stopitCount = 0;
        localStorage.setItem('stopit-count', stopitCount);
        stopitTimeout = new Date();
        localStorage.setItem('stopit-timeout', stopitTimeout)
    }
    
    if(stopitCount < 2) {
        // submit form over ajax
        $.ajax({
            url     : '/auth/login',
            type    : 'POST',
            data    : $('#login_form').serialize(),
            success : handle_login
        });
    } else {
        handle_login('lockedout');
    }
}

function handle_login(response) {
    $('html').css('cursor', 'auto');
    
    switch(response) {
        case 'migrated':
            display_login_message('This account has been migrated to a Mojang account.  Please use your email address to log in for the first time.');
        break;
        
        case 'OK':
            location.reload(true);
        break;
        
        case 'locked':
            display_login_message('New user signup has been disabled. Please wait 5 minutes and try again.');
        break;
        
        case 'lockedout':
            display_login_message('You have been locked out of signing in due to too many failed attempts.  Please wait 10 Minutes before trying again.');
        break;
        
        case 'bad login':
        case 'Bad Input':
        case 'Bad Password':
        default:
            // get stoppit time
            stopitCount = parseInt(localStorage.getItem('stopit-count'));
            stopitCount++;
            localStorage.setItem('stopit-count', stopitCount);
            localStorage.setItem('stopit-timeout', new Date());
            
            display_login_message('Either your username or password is invalid.  Check that you can login on <a href="http://minecraft.net/login">Minecraft.net</a> before trying again.');
        break;
    }
}

function display_login_message(data) {
    var alert = '<h4>Error!</h4> ' + data;
    $('#login-error').html(alert).slideDown();
}