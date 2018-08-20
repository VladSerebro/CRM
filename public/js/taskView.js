$(document).ready(function() {


    // Button Edit comment click
    $('.btn-edit').click(function(event){
        event.preventDefault();

        var str_id = event.target.id,
            comment_id = str_id.replace('btn_edit', ""),

            btnEdit = $(this),
            btnSave = $('#btn_save' + comment_id),
            commentObj = $('#comment_text' + comment_id),
            editorObj = $('#comment_editor' + comment_id);

        btnEdit.hide();
        btnSave.show();
        commentObj.hide();
        editorObj.show();

        editorObj.text(commentObj.text());
    });


    // Button Save comment click
    $('.btn-save').click(function(event){
        event.preventDefault();

        var str_id = event.target.id,
            comment_id = str_id.replace('btn_save', ""),

            btnSave = $(this),
            btnEdit = $('#btn_edit' + comment_id),
            commentObj = $('#comment_text' + comment_id),
            editorObj = $('#comment_editor' + comment_id);

        btnSave.hide();
        btnEdit.show();
        editorObj.hide();
        commentObj.show();

        var str = editorObj[0].value;

        commentObj.text(str);

        $.ajax({
            url: '/project/0/task/0/comment/edit/' + comment_id,
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                textVal: str
            },
            success: function(data){
                //alert('saved successfully');
            }
        });
    });


    // Button Upload file
    $('#btn_upload_file').click(function (event) {
        event.preventDefault();
        $('.input-file').click();
    });


    // input-file_Change
    $('.input-file').change(function (event) {
        event.preventDefault();

        var str_id = event.target.id,
            task_id = str_id.replace('input_file_to_task', "");

        var file = $('input[type=file]')[0].files[0];
        var reader = new FileReader();

        reader.readAsText(file);

        reader.onload = function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/project/0/task/' + task_id + '/file/upload',
                method: 'POST',
                data: {
                    contents: reader.result,
                    fileName: file.name
                },
                success: function(data){
                    alert(data);
                    location.reload();
                }
            });
        };
    });



});