function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.imgCircle')
                    .attr('src', e.target.result)
                    .width(300)
                    .height(300);
        };
        reader.readAsDataURL(input.files[0]);
        var fullPath = document.getElementById('image-input').value;
        if (fullPath) {
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            $('#image_name_preview').text('[' + filename + ']');
        }
    }
}

function readURL_hotel(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imghotel_edit')
                    .attr('src', e.target.result);
//                    .width(300)
//                    .height(300);
        };
        reader.readAsDataURL(input.files[0]);
        var fullPath = document.getElementById('image-input-hotel').value;
        if (fullPath) {
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            $('#image_name_preview_hotel').text('[' + filename + ']');
        }
    }
}