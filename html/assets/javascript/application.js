$(document).ready(function(){
    $('nav li').on('click', nav_click);
    $('#login_form').on('submit', user_login);
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
        success : function(data) {
            alert(data);
        }
    });
}