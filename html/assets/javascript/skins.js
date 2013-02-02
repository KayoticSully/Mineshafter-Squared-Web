$(document).ready(init);

function init() {
    $('#set-active').on('click', set_active_skin);
    $('#remove-active').on('click', remove_active_skin);
    init_iso_views();
    if(init3d()) {
        animate();
    }
}