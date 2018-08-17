<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; Charset=UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<textarea id="textField" name="text"></textarea> <br/>
<input type="button" id="btn" value="Go"/>

<script>
    $(document).ready(function() {
        $('#btn').click(function() {
            var textValue = $('#textField').val();

            $.ajax({
                url: 'test',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    text: text
                },
                success: function(data) {
                    alert(data);
                }
            });

        });
    });
</script>

</body>
</html>