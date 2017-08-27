    <!-- start: MAIN JAVASCRIPTS -->
    <!--[if lt IE 9]>
        <script src="<?=URL_PUBLIC?>frontend/bower_components/respond/dest/respond.min.js"></script>
        <script src="<?=URL_PUBLIC?>frontend/bower_components/html5shiv/dist/html5shiv.min.js"></script>
        <script src="<?=URL_PUBLIC?>frontend/bower_components/jquery-1.x/dist/jquery.min.js"></script>
        <![endif]-->
    <!--[if gte IE 9]><!-->
    <script type="text/javascript" src="<?=URL_PUBLIC?>frontend/bower_components/jquery/dist/jquery.min.js"></script>
    <!--<![endif]-->
    <script type="text/javascript" src="<?=URL_PUBLIC?>frontend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=URL_PUBLIC?>frontend/bower_components/blockUI/jquery.blockUI.js"></script>
    <script type="text/javascript" src="<?=URL_PUBLIC?>frontend/bower_components/jquery.transit/jquery.transit.js"></script>
    <script type="text/javascript" src="<?=URL_PUBLIC?>frontend/bower_components/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
    <script type="text/javascript" src="<?=URL_PUBLIC?>frontend/bower_components/jquery_appear/jquery.appear.js"></script>
    <script type="text/javascript" src="<?=URL_PUBLIC?>frontend/bower_components/jquery.cookie/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?=URL_PUBLIC?>frontend/js/min/main.min.js"></script>
    <!-- end: MAIN JAVASCRIPTS -->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <!-- RS5.0 Core JS Files -->
    <script src="<?=URL_PUBLIC?>frontend/plugins/slider-revolution/js/jquery.themepunch.tools.min.js?rev=5.0"></script>
    <script src="<?=URL_PUBLIC?>frontend/plugins/slider-revolution/js/source/jquery.themepunch.tools.min.js"></script>
    <script src="<?=URL_PUBLIC?>frontend/plugins/slider-revolution/js/jquery.themepunch.revolution.min.js?rev=5.0"></script>
    <script src="<?=URL_PUBLIC?>frontend/bower_components/flexslider/jquery.flexslider-min.js"></script>
    <script src="<?=URL_PUBLIC?>frontend/bower_components/jquery.stellar/jquery.stellar.min.js"></script>
    <script src="<?=URL_PUBLIC?>frontend/bower_components/jquery-colorbox/jquery.colorbox-min.js"></script>
	
	
	<script type="text/javascript" src="<?=URL_PUBLIC?>frontend/plugins/slider-revolution/js/extensions/revolution.extension.video.min.js"></script>
	<script type="text/javascript" src="<?=URL_PUBLIC?>frontend/plugins/slider-revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
	<script type="text/javascript" src="<?=URL_PUBLIC?>frontend/plugins/slider-revolution/js/extensions/revolution.extension.actions.min.js"></script>
	<script type="text/javascript" src="<?=URL_PUBLIC?>frontend/plugins/slider-revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
	<script type="text/javascript" src="<?=URL_PUBLIC?>frontend/plugins/slider-revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
	<script type="text/javascript" src="<?=URL_PUBLIC?>frontend/plugins/slider-revolution/js/extensions/revolution.extension.navigation.min.js"></script>
	<script type="text/javascript" src="<?=URL_PUBLIC?>frontend/plugins/slider-revolution/js/extensions/revolution.extension.migration.min.js"></script>
	<script type="text/javascript" src="<?=URL_PUBLIC?>frontend/plugins/slider-revolution/js/extensions/revolution.extension.parallax.min.js"></script>	
	
	<!-- INDEX -->
	<script src="<?=URL_PUBLIC?>frontend/js/min/index.min.js"></script>
	<!-- 
	CONTACT FAQ SERVICES TEAM ABOUT CAREERS EXAMPLE1 EXAMPLE2 EXAMPLE3 ITEM
	BUTTONS GRID_SYSTEM ICONS TYPOGRAPY 404 500 PRICING_TABLE SEARCH_RESULTS
	PAGE POST
	-->
    <script src="<?=URL_PUBLIC?>frontend/bower_components/flexslider/jquery.flexslider-min.js"></script>
    <!-- CONTACT -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLE_MAPS?>"></script>
    <script src="<?=URL_PUBLIC?>frontend/bower_components/gmaps/gmaps.min.js"></script>
    <!-- ABOUT -->
    <script src="<?=URL_PUBLIC?>frontend/bower_components/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- EXAMPLE1 EXAMPLE2 EXAMPLE3-->
    <script src="<?=URL_PUBLIC?>frontend/bower_components/mixitup/build/jquery.mixitup.min.js"></script>

    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script>
		var LinkD = function () {
			return {
				init: function () {
					$(".chargemenu").click(function() {
						$.ajax({
							url: url_app +  'site/page/'+$(this).data('folder')+'/'+$(this).data('file')+'/'+$(this).data('process'),
							beforeSend: function( data ) {
								$('#procesando').show();
								$('#contenido_dinamico').empty();
								$(".rd-navbar-nav").find(".rd-navbar-submenu").removeClass("opened").removeClass("focus");
								$(".rd-navbar-inner").find(".rd-navbar-nav-wrap").removeClass("active");
								$(".rd-navbar-panel").find(".rd-navbar-toggle").removeClass("active");
							},
							success: function(data) {
								$('#contenido_dinamico').html(data);
								$('#procesando').hide();
								$('html,body').animate({
								    scrollTop: $("body").offset().top
								}, 1000);
							}
						});
					});
				}
			};
		}();
		var LinkAjax = function () {
			return {
				init: function () {
					$(".load-content").click(function() {
						$.ajax({
							url: url_app +  'site/page/'+$(this).data('folder')+'/'+$(this).data('file')+'/'+$(this).data('process'),
							beforeSend: function( data ) {
								$('#procesando').show();
								$('#contenido_dinamico').empty();
							},
							success: function(data) {
								$('#contenido_dinamico').html(data);
								$('#procesando').hide();
							}
						});
					});
					$(".secondarysearch").click(function() {
						$.ajax({
							url: url_app +  'site/list_search',
							method: "POST",
							data: $("#secsearchform").serialize(),
							beforeSend: function( data ) {
								$('#dinamic_search_loader').show();
								$('#busqueda_dinamica_ajax').empty();
							},
							success: function(data) {
								$('#dinamic_search_loader').hide();
								$('#busqueda_dinamica_ajax').html(data);
							}
						});
					});
					$('#rd-search-form-input-1').keydown(function(e) {
						if (e.keyCode == 13) {
							$.ajax({
								url: url_app +  'site/list_search',
								method: "POST",
								data: $("#secsearchform").serialize(),
								beforeSend: function( data ) {
									$('#dinamic_search_loader').show();
									$('#busqueda_dinamica_ajax').empty();
								},
								success: function(data) {
									$('#dinamic_search_loader').hide();
									$('#busqueda_dinamica_ajax').html(data);
								}
							});
							return false;
						}
					});
				}
			};
		}();
		var StartNow = function () {
			var loadContetIndex = function (load) {
				$.ajax({
					url: url_app +  load,
					beforeSend: function( data ) {
						$('#procesando').show();
						$('#contenido_dinamico').empty();
					},
					success: function(data) {
						$('#contenido_dinamico').html(data);
						$('#procesando').hide();
					}
				});
			};
			return {
				init: function (load) {
					loadContetIndex(load);
				}
			};
		}();
		jQuery(document).ready(function() {
			LinkD.init();
			<?php if($load){ ?>
				StartNow.init('<?=$load?>');
			<?php } ?>
                     $().UItoTop({
                            easingType: 'easeOutQuart',
                            containerClass: 'ui-to-top fa fa-angle-up'
                     });
		});
    </script>
