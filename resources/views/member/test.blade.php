<html>
<head>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    @FilemanagerScript
</head>
<body>
    <form method="POST" action="member">
        @csrf
        <div>
        <textarea id="editor" name="main"></textarea>
                    <script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
                    <script>
                        window.onload=function(){
                            CKEDITOR.replace('editor',{
                                filebrowserBrowseUrl:filemanager.ckBrowseUrl
                            })
                        }
                    </script>
        </div>
    </form>
</body>
</html>

