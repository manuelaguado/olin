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
					$(".load-content").click(function() {
						$.ajax({
							url: 'site/page/'+$(this).data('folder')+'/'+$(this).data('file'),
							beforeSend: function( data ) {
								$('#procesando').show();
								$('#proceso_listo').hide();
								$('#contenido_dinamico').empty();
							},
							success: function(data) {  
								$('#contenido_dinamico').html(data);  
							}  
						});  
					});
				}
			};
		}();
		
		var StartNow = function () {
			var loadContetIndex = function () {        
				$.ajax({
					url: 'site/page/index/index',
					beforeSend: function( data ) {
						$('#procesando').show();
						$('#proceso_listo').hide();
					},
					success: function(data) {  
						$('#contenido_dinamico').html(data);  
					}  
				});
			};
			return {
				init: function () {
					loadContetIndex();
				}
			};
		}();
		jQuery(document).ready(function() {
			StartNow.init();
			Main.init();
			LinkD.init();
		});
    </script>