
$(document).ready(init);

function init() {
    $('#add-server').on('click', display_new_server_form);
    $('.editable').on('focusin', clearText);
    $('.editable').on('focusout', restoreText);
    $('#server-list .navbar li').on('click', toggleFilter);
}

function display_new_server_form() {
    var element = $('#new-server');
    
    if(element.css('display') == 'none') {
        element.slideDown();
    }
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

function toggleFilter() {
    $(this).toggleClass('active');
}