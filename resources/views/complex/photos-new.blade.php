@extends('layout')

@section('content')

    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-fixed-top .navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="https://github.com/blueimp/jQuery-File-Upload">jQuery File Upload</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="https://github.com/blueimp/jQuery-File-Upload/tags">Download</a></li>
                    <li><a href="https://github.com/blueimp/jQuery-File-Upload">Source Code</a></li>
                    <li><a href="https://github.com/blueimp/jQuery-File-Upload/wiki">Documentation</a></li>
                    <li><a href="https://blueimp.net">&copy; Sebastian Tschan</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>jQuery File Upload Demo</h1>
        <h2 class="lead">Basic version</h2>
        <ul class="nav nav-tabs">
            <li class="active"><a href="basic.html">Basic</a></li>
            <li><a href="basic-plus.html">Basic Plus</a></li>
            <li><a href="index.html">Basic Plus UI</a></li>
            <li><a href="angularjs.html">AngularJS</a></li>
            <li><a href="jquery-ui.html">jQuery UI</a></li>
        </ul>
        <br>
        <blockquote>
            <p>File Upload widget with multiple file selection, drag&amp;drop support and progress bar for jQuery.<br>
                Supports cross-domain, chunked and resumable file uploads.<br>
                Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.</p>
        </blockquote>
        <br>
        <!-- The fileinput-button span is used to style the file input field as button -->
        <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
            <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
        <br>
        <br>
        <!-- The global progress bar -->
        <div id="progress" class="progress">
            <div class="progress-bar progress-bar-success"></div>
        </div>
        <!-- The container for the uploaded files -->
        <div id="files" class="files"></div>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Demo Notes</h3>
            </div>
            <div class="panel-body">
                <ul>
                    <li>The maximum file size for uploads in this demo is <strong>999 KB</strong> (default file size is unlimited).</li>
                    <li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction).</li>
                    <li>Uploaded files will be deleted automatically after <strong>5 minutes or less</strong> (demo files are stored in memory).</li>
                    <li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage (see <a href="https://github.com/blueimp/jQuery-File-Upload/wiki/Browser-support">Browser support</a>).</li>
                    <li>Please refer to the <a href="https://github.com/blueimp/jQuery-File-Upload">project website</a> and <a href="https://github.com/blueimp/jQuery-File-Upload/wiki">documentation</a> for more information.</li>
                    <li>Built with the <a href="http://getbootstrap.com/">Bootstrap</a> CSS framework and Icons from <a href="http://glyphicons.com/">Glyphicons</a>.</li>
                </ul>
            </div>
        </div>
    </div>

@endsection

@section('js-scripts')

    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="{{ asset("js/file-uploader/vendor/jquery.ui.widget.js") }}"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- blueimp Gallery script -->
    <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="{{ asset("js/file-uploader/jquery.iframe-transport.js") }}"></script>
    <!-- The basic File Upload plugin -->
    <script src="{{ asset("js/file-uploader/jquery.fileupload.js") }}"></script>
    <!-- The File Upload processing plugin -->
    <script src="{{ asset("js/file-uploader/jquery.fileupload-process.js") }}"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="{{ asset("js/file-uploader/jquery.fileupload-image.js") }}"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="{{ asset("js/file-uploader/jquery.fileupload-audio.js") }}"></script>
    <!-- The File Upload video preview plugin -->
    <script src="{{ asset("js/file-uploader/jquery.fileupload-video.js") }}"></script>
    <!-- The File Upload validation plugin -->
    <script src="{{ asset("js/file-uploader/jquery.fileupload-validate.js") }}"></script>
    <!-- The File Upload user interface plugin -->
    <script src="{{ asset("js/file-uploader/jquery.fileupload-ui.js") }}"></script>
    <!-- The main application script -->
    <script src="{{ asset("js/file-uploader/main.js") }}"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
    <script src="{{ asset("js/file-uploader/jquery.xdr-transport.js") }}"></script>
    <![endif]-->

    <script>
        $(function () {
            'use strict';
            // Change this to the location of your server-side upload handler:
            var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/';
            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        $('<p/>').text(file.name).appendTo('#files');
                    });
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                    );
                }
            }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');
        });
    </script>
@endsection
