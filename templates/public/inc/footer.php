	<footer>
		<div class="wrap clearfix">
			<section class="bottom">
				<p class="copy">2017 © ManageTour. Design by BK_TOUR</p>
			</section>
		</div>
	</footer>
	
	<!--//footer-->
	<script type="text/javascript" src="../templates/public/js/css3-mediaqueries.js"></script>
	<script type="text/javascript" src="../templates/public/js/sequence.jquery-min.js"></script>
	<script type="text/javascript" src="../templates/public/js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="../templates/public/js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="../templates/public/js/sequence.js"></script>
	<script type="text/javascript" src="../templates/public/js/selectnav.js"></script>
	<script type="text/javascript" src="../templates/public/js/scripts.js"></script>
	<script type="text/javascript">	
		$(document).ready(function(){
			$(".form").hide();
			$(".form:first").show();
			$(".f-item:first").addClass("active");
			$(".f-item:first span").addClass("checked");
		});
	</script>
	<script>
		// Initiate selectnav function
		selectnav();
	</script>
	<script type="text/javascript">
		function initialize() {
			var secheltLoc = new google.maps.LatLng(49.47216, -123.76307);
	
			var myMapOptions = {
				 zoom: 15
				,center: secheltLoc
				,mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var theMap = new google.maps.Map(document.getElementById("map_canvas"), myMapOptions);
	
	
			var marker = new google.maps.Marker({
				map: theMap,
				draggable: true,
				position: new google.maps.LatLng(49.47216, -123.76307),
				visible: true
			});
	
			var boxText = document.createElement("div");
			boxText.innerHTML = "<strong>Best ipsum hotel</strong><br />1400 Pennsylvania Ave,<br />Washington DC<br />www.bestipsumhotel.com";
	
			var myOptions = {
				 content: boxText
				,disableAutoPan: false
				,maxWidth: 0
				,pixelOffset: new google.maps.Size(-140, 0)
				,zIndex: null
				,closeBoxURL: ""
				,infoBoxClearance: new google.maps.Size(1, 1)
				,isHidden: false
				,pane: "floatPane"
				,enableEventPropagation: false
			};
	
			google.maps.event.addListener(marker, "click", function (e) {
				ib.open(theMap, this);
			});
	
			var ib = new InfoBox(myOptions);
			ib.open(theMap, marker);
		}
	</script>
</body>
</html>

	<!--footer-->
