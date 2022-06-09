<!DOCTYPE html>
<html>
    <head>
        <title>Tinymce Test</title>
        <style type="text/css">
            html, body {
                font-family: consolas, monospace;
                width: 100%;
                height: 100%;
                padding: 0px;
                margin: 0px;
                cursor: default;
            }
            input, textarea, select {
                box-sizing: border-box;
            }
            .mce-tinymce {
                border-width: 0px !important;
            }
        </style>
        <script type="text/javascript" src="js/tinymce/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">

            tinymce.init({
                selector: "textarea",

                // ===========================================
                // INCLUDE THE PLUGIN
                // ===========================================

                plugins: [
                    "advlist autolink lists link charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste jbimages"
                ],

                // ===========================================
                // PUT PLUGIN'S BUTTON on the toolbar
                // ===========================================

                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",

                // ===========================================
                // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
                // ===========================================

                relative_urls: false
            });

        </script>
        <!-- /TinyMCE -->
    </head>
    <body>
        <textarea>Percobaan integrasi TinyMCE pada form input!</textarea>
    </body>
</html>