$(document).ready(function() {
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
});