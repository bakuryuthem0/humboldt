 {{ HTML::script('plugins/ckeditor/ckeditor.js') }}

 <script>
   $(function () {
     // Replace the <textarea id="editor1"> with a CKEditor
     // instance, using default configuration.
     CKEDITOR.replace('editor1');
     //bootstrap WYSIHTML5 - text editor
   });
 </script>