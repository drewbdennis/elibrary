<!-- start of features -->
<?php if(!empty($features)) : ?>
<div id="featurewrap">
	<div id="myCarousel" class="carousel slide">
	  <!-- Carousel items -->
	  <div class="carousel-inner">
	  	<?php foreach($features as $feature) : ?>
	  		<div class="item">
			    <img src="<?php echo base_url()."assets/images/".$feature->img_url;?>" alt="">
			    <div class="carousel-caption">
			      <h4><?php echo $feature->title; ?></h4>
			      <p><?php echo $feature->content; ?></p>
			    </div>
			</div>
	  	<?php endforeach; ?>
	  </div>
	  <script>
	  	$('.carousel').carousel({
		  interval: 10000
		});
	  </script>
	  <!-- Carousel nav -->
	  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>
<div class="clearfix"></div>
<?php else : ?>
<div id="featurewrap">
	<div id="myCarousel" class="carousel slide">
	  <!-- Carousel items -->
	  <div class="carousel-inner">
	    <div class="active item">
		    <img src="<?php echo base_url();?>assets/images/test1.jpg" alt="">
		    <div class="carousel-caption">
		      <h4>First Thumbnail label</h4>
		      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
		    </div>
		</div>
	    <div class="item">
		    <img src="<?php echo base_url();?>assets/images/test2.jpg" alt="">
		    <div class="carousel-caption">
		      <h4>First Thumbnail label</h4>
		      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
		    </div>
		</div>
		<div class="item">
		    <img src="<?php echo base_url();?>assets/images/test3.jpg" alt="">
		    <div class="carousel-caption">
		      <h4>First Thumbnail label</h4>
		      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
		    </div>
		</div>
	  </div>
	  <script>
	  	$('.carousel').carousel({
		  interval: 10000
		});
	  </script>
	  <!-- Carousel nav -->
	  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>
<div class="clearfix"></div>
<?php endif; ?>
<!-- end of features -->