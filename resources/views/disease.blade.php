<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ LAConfigs::getByKey('site_description') }}">
    <meta name="author" content="Elegant Coders">

    <meta property="og:title" content="{{ LAConfigs::getByKey('sitename') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{ LAConfigs::getByKey('site_description') }}" />
    
    <meta property="og:url" content="http://laraadmin.com/" />
    <meta property="og:sitename" content="laraAdmin" />
	<meta property="og:image" content="http://demo.adminlte.acacha.org/img/LaraAdmin-600x600.jpg" />
    
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@laraadmin" />
    <meta name="twitter:creator" content="@laraadmin" />
    
    <title>{{ LAConfigs::getByKey('sitename') }}</title>
        <!-- Bootstrap 3.3.4 -->
    <link href="http://localhost:8000/la-assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
    
    <link href="http://localhost:8000/la-assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
    <link href="http://localhost:8000/la-assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!--<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />-->
    
    <!-- Theme style -->
    <link href="http://localhost:8000/la-assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="http://localhost:8000/la-assets/css/skins/skin-black.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="http://localhost:8000/la-assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link rel="stylesheet" type="text/css" href="http://localhost:8000/la-assets/plugins/datatables/datatables.min.css"/>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/la-assets/css/bootstrap.css') }}" rel="stylesheet">

	<link href="{{ asset('la-assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Custom styles for this template -->
    <link href="{{ asset('/la-assets/css/main.css') }}" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    <script src="{{ asset('/la-assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('/la-assets/js/smoothscroll.js') }}"></script>

    <style type="text/css">
    	.single-block {
		    border: 1px #fff solid;
		    margin: 20px 0;
		    padding: 15px;
		    text-align: left;
		    font-size: 18px;
		}
		.single-block label {
		    padding-left: 15px;
		}
        .diseaselist{
            text-align: left;
            font-size: 22px;
            font-weight: 500;
        }
    </style>

</head>

<body data-spy="scroll" data-offset="0" data-target="#navigation">

<!-- Fixed navbar -->
<div id="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><b>{{ LAConfigs::getByKey('sitename') }}</b></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#home" class="smoothScroll">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <!--<li><a href="{{ url('/register') }}">Register</a></li>-->
                @else
                    <li><a href="{{ url(config('laraadmin.adminRoute')) }}">{{ Auth::user()->name }}</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<section id="about" name="about"></section>
<!-- INTRO WRAP -->
<div id="intro">
    <div class="container">
        <div class="row centered">
            <div class="col-sm-8 col-sm-offset-2">
                <h3>These are your Potential Disease, Please Visit The Related Doctor</h3>
                <ol class="diseaselist">
                    @foreach($diseaselist as $disease)
                        <li><a href="/diseases/{{ $disease->id }}">{{ $disease->name }}</a></li>
                        <div class="description">
                            <ul>
                                <li>
                                    <span><strong>Desctiption:</strong></span><br>
                                    {{ $disease->description }}
                                </li>
                                <li>
                                    <span><strong>Precautions:</strong></span><br>
                                    {{ $disease->precaution }}
                                </li>
                                <li>
                                    <span><strong>To Avoid:</strong></span><br>
                                    {{ $disease->avoid }}
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </ol>
            </div>
        </div>
        <br>
        <hr>
    </div> <!--/ .container -->
</div><!--/ #introwrap -->


<div id="c">
    <div class="container">
        <p>
            <strong>Copyright &copy; 2016. Powered by <a href="#"><b>Elegant Coders</b></a>
        </p>
    </div>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- jQuery 2.1.4 -->
<script src="http://localhost:8000/la-assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="http://localhost:8000/la-assets/js/bootstrap.min.js" type="text/javascript"></script>

<!-- jquery.validate + select2 -->
<script src="http://localhost:8000/la-assets/plugins/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
<script src="http://localhost:8000/la-assets/plugins/select2/select2.full.min.js" type="text/javascript"></script>
<script src="http://localhost:8000/la-assets/plugins/bootstrap-datetimepicker/moment.min.js" type="text/javascript"></script>
<script src="http://localhost:8000/la-assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="http://localhost:8000/la-assets/js/app.min.js" type="text/javascript"></script>

<script src="http://localhost:8000/la-assets/plugins/stickytabs/jquery.stickytabs.js" type="text/javascript"></script>
<script src="http://localhost:8000/la-assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>



<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->

<script src="http://localhost:8000/la-assets/plugins/datatables/datatables.min.js"></script>
<script>
$(function () {
    $("#example1").DataTable({
        processing: true,
        serverSide: true,
        ajax: "http://localhost:8000/admin/history_dt_ajax",
        language: {
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            searchPlaceholder: "Search"
        },
                columnDefs: [ { orderable: false, targets: [-1] }],
            });
    $("#history-add-form").validate({
        
    });
});
</script>
<script>
    $('.carousel').carousel({
        interval: 3500
    })
</script>
</body>
</html>
