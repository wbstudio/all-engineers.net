<html>
<head>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    @FilemanagerScript
</head>
<body>
    <form method="POST" action="member">
        @csrf
        <div>
        <input type="text" name="aaaaaa">
        <textarea id="editor" class="111" name="main" style="border:3px solid #555;"></textarea>
        <textarea id="editor" class="111" name="main01" style="border:3px solid #555;"></textarea>
            <script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
            <script>
                window.onload=function(){
                    CKEDITOR.replaceAll('111',{
                        filebrowserBrowseUrl:filemanager.ckBrowseUrl
                    })
                }
            </script>
        </div>
    </form>
</body>
</html>
