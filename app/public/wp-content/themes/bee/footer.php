<footer id="anchor_contact" class="footer">
	<div class="footer__container container">
		<div class="footer__row">
			<div class="footer__column">
				<h3 class="footer__sub-title">Get in touch</h3>
				<a href="tel:07939043959"><h2 class="footer__title">07939043959</h2></a>
			</div>
			<div class="footer__column">
				<h3 class="footer__sub-title">Send us an email</h3>
				<a href="mailto:info@palmer-house.co.uk"><h2 class="footer__title">info@palmer-house.co.uk</h2></a>
			</div>
			<div class="footer__column">
				<h3 class="footer__sub-title">Get social</h3>
				<ul class="footer__social">
					<li class="footer__social-icon">
						<a href="http://instagram.com"><span class="socicon socicon-instagram"></span></a>
					</li>
					<li class="footer__social-icon">
						<a href="http://twitter.com"><span class="socicon socicon-twitter"></span></a>
					</li>
					<li class="footer__social-icon">
						<a href="http://facebook.com"><span class="socicon socicon-facebook"></span></a>
					</li>
				</ul>
			</div>
		</div>
		<div class="footer__bottom">
			<p class="footer__paragraph">© 2019 • The Palmer House</p>
		</div>
	</div>
</footer>

<script src='https://api.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>

<script>

	mapboxgl.accessToken = 'pk.eyJ1Ijoiam9yZGRvYmJvIiwiYSI6ImNqNHR3eGo4MDAwNTAycG50emJsbG5zOXEifQ.WRG1CWGXAJSFefjfg2tqvQ';
	var map = new mapboxgl.Map({
	    container: 'map',
	    style: 'mapbox://styles/jorddobbo/cjjq8ko5u0cax2srj15q4vbkh',
	    zoom:14.1,
  		center: [-1.154583,52.971800],
	});

	map.scrollZoom.disable();

	map.on("load", function () {
  /* Image: An image is loaded and added to the map. */
  map.loadImage("<?php echo get_template_directory_uri(); ?>/assets/img/home/map__pin.png", function(error, image) {
      if (error) throw error;
      map.addImage("custom-marker", image);
      /* Style layer: A style layer ties together the source and image and specifies how they are displayed on the map. */
      map.addLayer({
        id: "markers",
        type: "symbol",
        /* Source: A data source specifies the geographic coordinate where the image marker gets placed. */
        source: {
          type: "geojson",
          data: {
            type: "FeatureCollection",
            features:[{"type":"Feature","geometry":{"type":"Point","coordinates":[-1.154696,52.971200]}}]}
        },
        layout: {
          "icon-image": "custom-marker",
        }
      });
    });
});
	
</script>

<?php wp_footer(); ?>