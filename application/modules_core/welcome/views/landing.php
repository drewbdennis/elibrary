<!-- start of the content -->

<div class="container white">
	<div class="row">
		<div class="span4 events">
			<h2>
				<a href="#">Events</a>
			</h2>
			<!-- event list -->
			<?php if(!empty($events)) : ?>
			<?php foreach($events as $event) : ?>
			<div class="row event">
				<div class="span1 date">
					<span class="day named"><?php echo $event->day; ?></span>
					<span class="month"><?php echo $event->month; ?></span>
				</div>
				<div class="span3 info">
					<h4><a href="#"><?php echo $event->title; ?></a></h4>
					<p>
						<?php echo $event->duration; ?>
						<br/>
						<?php echo $event->location; ?>
					</p>
				</div>
			</div>
			<?php endforeach; ?>
			
			<!-- ends -->
			<ul class="more_events">
				<li>
					<a href="#">More Events <i class="icon-play"></i></a>
				</li>
			</ul>
			<?php else: ?>
			<!-- event list -->
			<div class="row event">
				<div class="span1 date">
					<span class="day named">Sat.</span>
					<span class="month">Jan. 5</span>
				</div>
				<div class="span3 info">
					<h4><a href="#">Event Headings</a></h4>
					<p>
						1:00–4:00 PM
						<br/>
						Smart Museum of Art
					</p>
				</div>
			</div>
			<div class="row event">
				<div class="span1 date">
					<span class="day named">Sat.</span>
					<span class="month">Jan. 5</span>
				</div>
				<div class="span3 info">
					<h4><a href="#">Event Headings</a></h4>
					<p>
						1:00–4:00 PM
						<br/>
						Smart Museum of Art
					</p>
				</div>
			</div>
			<div class="row event">
				<div class="span1 date">
					<span class="day named">Sat.</span>
					<span class="month">Jan. 5</span>
				</div>
				<div class="span3 info">
					<h4><a href="#">Event Headings</a></h4>
					<p>
						1:00–4:00 PM
						<br/>
						Smart Museum of Art
					</p>
				</div>
			</div>
			<div class="row event">
				<div class="span1 date">
					<span class="day named">Sat.</span>
					<span class="month">Jan. 5</span>
				</div>
				<div class="span3 info">
					<h4><a href="#">Event Headings</a></h4>
					<p>
						1:00–4:00 PM
						<br/>
						Smart Museum of Art
					</p>
				</div>
			</div>
			<div class="row event">
				<div class="span1 date">
					<span class="day named">Sat.</span>
					<span class="month">Jan. 5</span>
				</div>
				<div class="span3 info">
					<h4><a href="#">Event Headings</a></h4>
					<p>
						1:00–4:00 PM
						<br/>
						Smart Museum of Art
					</p>
				</div>
			</div>
			<!-- ends -->
			<ul class="more_events">
				<li>
					<a href="#">More Events <i class="icon-play"></i></a>
				</li>
			</ul>
			<?php endif; ?>
		</div>
		<div class="span10">
			<!-- spotlight -->
			<?php if(!empty($spotlights)) : ?>
				<div class="row spotlight">
					<?php foreach($spotlights as $spotlight) : ?>
					<div style="background:<?php echo $spotlight->color; ?>;" class="span2" id="<?php echo $spotlight->name; ?>">
						<a href="#">
							<h2><?php echo $spotlight->title; ?></h2>
							<img alt="" src="<?php echo base_url()."assets/images/".$spotlight->img_url;?>">
						</a>
					</div>
					<?php endforeach; ?>
				</div>
			<?php else: ?>
				<!-- spotlight -->
				<div class="row spotlight">
					<div style="background:#da3860;" class="span2" id="ict_center">
						<a href="#">
							<h2>ICT Center</h2>
							<img alt="" src="<?php echo base_url() . 'assets/images/ict_center.jpg'; ?>">
						</a>
					</div>
					<div style="background:#07809b;" class="span2" id="administration">
						<a href="#">
							<h2>Administration</h2>
							<img alt="" src="<?php echo base_url() . 'assets/images/administrative_bldg.gif'; ?>">
						</a>
					</div>
					<div style="background:#800000;" class="span2" id="law_school">
						<a href="#">
							<h2>Law School</h2>
							<img alt="" src="<?php echo base_url() . 'assets/images/law_school.gif'; ?>">
						</a>
					</div>
					<div style="background:#8c365d;" class="span2" id="agriculture_forestry">
						<a href="#">
							<h2>Agriculture & Forestry</h2>
							<img alt="" src="<?php echo base_url() . 'assets/images/lab2.gif'; ?>">
						</a>
					</div>
				</div>
				<!-- ends -->
			<?php endif; ?>
			<!-- ends -->
			<div class="row luconnect">
				<hr />
				
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="container">
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<!-- end of the content -->