<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Home | {{ config('app.name', 'iFam') }}</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="icon" href="/assets/img/ifam-square.png" type="image/png" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="/assets/plugins/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="/assets/plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="/assets/plugins/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css">
		<link rel="stylesheet" href="/assets/plugins/fullcalendar/dist/fullcalendar.min.css">
        <link rel="stylesheet" href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/assets/plugins/jvectormap/jquery-jvectormap.css">
        <link rel="stylesheet" href="/assets/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="/assets/plugins/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="/assets/plugins/c3/c3.min.css">
        <link rel="stylesheet" href="/assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="/assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="/assets/plugins/mohithg-switchery/dist/switchery.min.css">
		<link rel="stylesheet" href="/assets/plugins/select2/dist/css/select2.min.css">
		<link rel="stylesheet" href="/assets/plugins/chartist/dist/chartist.min.css">
        <link rel="stylesheet" href="/assets/dist/css/theme.min.css">
        <link rel="stylesheet" href="/assets/dist/css/custom.css">
        <script src="/assets/src/js/vendor/modernizr-2.8.3.min.js"></script>
		
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		<noscript>
		  <strong>We're sorry but <%= htmlWebpackPlugin.options.title %> doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
		</noscript>

		<div class="wrapper">
            <x-account.header />

            <div class="page-wrap">
                <x-account.sidebar />
				
                <div class="main-content">
					{{ $slot }}
                </div>

                <x-account.footer />
                
            </div>
        </div>
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="/assets/src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="/assets/plugins/popper.js/dist/umd/popper.min.js"></script>
        <script src="/assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
        <script src="/assets/plugins/screenfull/dist/screenfull.js"></script>
        <script src="/assets/plugins/moment/moment.js"></script>
		<script src="/assets/plugins/fullcalendar/dist/fullcalendar.min.js"></script>
        <script src="/assets/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js"></script>
		<script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
		<script src="/assets/plugins/d3/dist/d3.min.js"></script>
        <script src="/assets/plugins/c3/c3.min.js"></script>
		<script src="/assets/plugins/select2/dist/js/select2.min.js"></script>
        <script src="/assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
        <script src="/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script src="/assets/plugins/jquery.repeater/jquery.repeater.min.js"></script>
		<script src="/assets/plugins/mohithg-switchery/dist/switchery.min.js"></script>
		<script src="/assets/plugins/chartist/dist/chartist.min.js"></script>
        <script src="/assets/js/chart-chartist.js"></script>
        <script src="/assets/js/tables.js"></script>
        <script src="/assets/js/widgets.js"></script>
        <script src="/assets/js/charts.js"></script>
		<script src="/assets/plugins/owl.carousel/dist/owl.carousel.min.js"></script>
		<script src="/assets/js/carousel.js"></script>
		<script src="/assets/js/form-advanced.js"></script>
		<script src="/assets/js/calendar.js"></script>
		
        <script src="/assets/dist/js/theme.js"></script>
		<script src="/assets/dist/js/custom.js"></script>
		
    </body>
</html>