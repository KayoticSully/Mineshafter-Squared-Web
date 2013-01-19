var server = null;

$(document).ready(init);

function init() {
    server = new Server($('#server-data').data('json'), true);
}