var login_form_animation_timeout;

$(document).ready(function(){
    $('nav li').on('click', nav_click);
    $('#login_form').on('submit', user_login);
    $('#login_form').on('click', '#dismiss', dismiss);
    $('#login_form').on('focusin', show_login_form);
    $('#login_form').on('focusout', hide_login_form);
});

function show_login_form() {
    clearTimeout(login_form_animation_timeout);
    
    var $this = $('#home_nav');
    if($this.height() < 110)
    {
        $this.animate({
            height: '110px'
        }, 'linear');
        
        $('#login_actions').fadeIn();
    }
}

function hide_login_form() {
    
    var $this = $('#home_nav');
    console.log($('#login_form:focus').size());
    if($this.height() > 70)
    {
        login_form_animation_timeout = setTimeout(do_hide_login, 10);
    }
}

function do_hide_login() {
    $('#login_actions').fadeOut();
    
    $('#home_nav').animate({
        height: '70px'
    }, 'linear');
}

function nav_click(event) {
    var location = $(this).find('>a').attr('href');
    
    if(location != undefined)
        window.location = location;
}

function user_login(event) {
    // make sure form does not submit
    event.preventDefault();
    
    // make login pane smaller again
    $('#login_form').focusout();
    
    // hide input fields and show loading
    $('.login_section').hide();
    $('.login_load').show();
    
    // gather input
    var username = document.getElementById('username').value.trim();
    var password = document.getElementById('password').value.trim();
    
    // submit form over ajax
    $.ajax({
        url     : '/auth/login',
        type    : 'POST',
        data    : {
            username : username,
            password : password
        },
        success : handle_login
    });
}

function handle_login(response) {
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

function display_login_message(message) {
    show_login_form();
    $('.login_section').hide();
    $('.login_message').html(message).show();
    $('.message_dismiss').show();
}

function dismiss(event) {
    $('.login_section').hide();
    $('.login_message').html('');
    
    $('#login_fields').show();
    $('#login_actions').show();
}