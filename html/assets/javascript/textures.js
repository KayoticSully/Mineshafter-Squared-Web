$(document).ready(init);

function init() {
    $('#create-texture').on('click', create_texture);
}

function create_texture(event) {
    // BAM File upload via Ajax!
    // Get form data. The element MUST BE THE FORM not an element
    // in the form (as obvious as that is, I need this comment here)
    var form_data = new FormData(document.getElementById('texture-form'));
    $.ajax({
        url: "/textures/upload_skin",
        type: "POST",
        data: form_data,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery that you know better about the content
        success:function(data) {
            $('.modal-body').html(data);
        }
    });
}