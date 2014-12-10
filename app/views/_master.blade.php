<!DOCTYPE html>

        <!--    WilXC Style                                                             -->
        <!--    A adventure in xenserver managment via the web                          -->
        <!--    Wil Birkmaier                                                           -->

<html>

<head>
	<title>WilXC</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex">
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css"/>
    <!-- Bootstrap Mobile View -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome css for bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="/css/starter-template.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
</head>

<body>
    
    <!-- Added for  'flash-message' with Bootstrap Stylings -->
    @if(Session::get('flashBanner'))
        <div class="alert" style="border: 2px solid #a1a1a1; background-color: #e6e7e9">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ Session::get('flashBanner') }}
        </div>
    @endif
    
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
	        	<div class="navbar-header">
        			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><i class="fa fa-home fa-fw"></i> WilXC Style</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
	
					@yield('active')

				</ul>
			</div>
		</div>
	</div>

    	<div class="container">

		<div class="starter-template">
			<p class="lead">

			@yield('content')
			
		</div>
	</div>	

    <a href="/xenapi-1.0.6.pdf">Download XenAPI PDF</a>
    <br>
    <a href="http://docs.vmd.citrix.com/XenServer/6.2.0/1.0/en_gb/api/">Citrix Xenserver 6.2 API</a>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="js/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>	

</body>

</html>
