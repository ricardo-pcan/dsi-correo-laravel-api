<!DOCTYPE html>
<html lang="es" ng-app="dsi_correo_main">
<head>
	<meta charset="UTF-8">
	<title>{{ $title }}</title>
	@section('styles')
		<link rel="stylesheet" href="{{ asset('vendor/css/app.css') }}">
	@show
</head>
<body>
	<nav class="navbar navbar-default">
	  	<div class="container">
	    	<div class="navbar-header">
	    			<a class="navbar-brand" id="navbar-ipn-logo" href="#">
	        			<img class="img-responsive" alt="IPN" src="{{ asset( 'vendor/images/ipn_logo.png' ) }}">
	      			</a>
	    			<a class="navbar-brand" id="navbar-cgfie-logo" href="#">
	        			<img alt="CGFIE"  class="img-responsive" src="{{ asset( 'vendor/images/logo_cgfie.png' ) }}">
	      			</a>
	    	</div>
	    	<p class="navbar-text">{{ $title }}</p>
	    	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    	<ul class="nav navbar-nav navbar-right">
		    		@foreach( $menu_items as $item )
						<li><a href="{{ $item['url'] }}">{{ $item['text']}}</a></li>
		    		@endforeach
		    	</ul>
	    	</div>
	  	</div>
	</nav>
	@section( 'navbar' )

	@show


	<div class="content">
			@yield( 'content' )
	</div>


	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-8 col-md-offset-2">
					<div class="text-center">
						Coordinación General de Formación e Innovación Educativa (CGFIE) <br />
			            <small style="color:#639;">
			            Edificio "Adolfo Ruiz Cortines" Av. Wilfrido Massieu s/n esq. Luis Enrique Erro, <br />
			            Unidad Profesional "Adolfo López Mateos", Zacatenco, Ciudad de México, D.F., C.P. 07738.
					</div>
				</div>
			</div>
		</div>
	</footer>
	@section( 'scripts' )
		<script src="{{ asset('vendor/js/app.js/') }}"></script>
		<script src="{{ asset('vendor/js/angular.min.js/') }}"></script>
        <script src="{{ asset('vendor/js/angular-cookies.min.js/') }}"></script>
        <script src="{{ asset('vendor/js/query-string.js/') }}"></script>
		<script src="{{ asset('vendor/js/angular-oauth2.min.js/') }}"></script>
        <script src="{{ asset('assets/js/core.js') }}"></script>
	@show
</body>
</html>
