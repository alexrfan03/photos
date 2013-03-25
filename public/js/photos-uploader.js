$(document).ready(function () {
    var uploader = new plupload.Uploader({
        runtimes : 'html5,flash,gears,silverlight,browserplus',
        browse_button : 'select-files',
        container: 'plupload-container',
        max_file_size : '1mb',
        file_data_name : 'image',
        url : upload_post_url,
        resize : {width : 800, height : 600, quality : 90},
        flash_swf_url : bundle_url + 'addons/plupload/plupload.flash.swf',
        silverlight_xap_url : bundle_url + 'addons/plupload/plupload.silverlight.xap',
        filters : [
            {title : "Image files", extensions : "jpg,gif,png"},
        ],
        multipart_params : {
            csrf_token : session_token,
            gallery_id : gallery_id
        }
    });

    uploader.bind('Init', function(up, params) {
        $('#filelist').html("<p><strong>File list</strong></p>");
    });

    $('#upload-files').click(function(e) {
        e.preventDefault();
        uploader.start();
    });

    uploader.init();

    uploader.bind('FilesAdded', function(up, files) {
        $.each(files, function(i, file) {
            $('#filelist').append(
                '<div id="' + file.id + '">' +
                    file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
                    '</div>');
        });

        up.refresh(); // Reposition Flash/Silverlight
    });

    uploader.bind('UploadProgress', function(up, file) {
        $('#' + file.id + " b").html(file.percent + "%");
    });

    uploader.bind('Error', function(up, err) {
        $('#filelist').append("<div>Error: " + err.code +
                              ", Message: " + err.message +
                              (err.file ? ", File: " + err.file.name : "") +
                              "</div>"
                             );

        up.refresh(); // Reposition Flash/Silverlight
    });

    uploader.bind('FileUploaded', function(up, file) {
        $('#' + file.id + " b").html("100%");
    });

    uploader.bind('UploadComplete', function(up, file) {
        location.reload();
    });
});
