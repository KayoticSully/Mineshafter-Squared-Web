$(document).ready(function(){
    $('nav li').on('click', nav_click);
    $('#login_form').on('submit', user_login);
    $('#login_form').on('click', '#dismiss', dismiss);
});

function nav_click(event) {
    var location = $(this).find('>a').attr('href');
    
    if(location != undefined)
        window.location = location;
}

function user_login(event) {
    // make sure form does not submit
    event.preventDefault();
    
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
        
        case 'bad login':
        case 'Bad Input':
        case 'Bad Password':
        default:
            display_login_message('Either your username or password is invalid.  Check that you can login on <a href="http://minecraft.net/login">Minecraft.net</a> before trying again.');
        break;
    }
}

function display_login_message(message) {
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