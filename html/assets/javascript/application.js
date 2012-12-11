$(document).ready(function(){
    $('nav li').on('click', nav_click);
});

function nav_click(event) {
    var location = $(this).find('>a').attr('href');
    
    if(location != undefined)
        window.location = location;
}