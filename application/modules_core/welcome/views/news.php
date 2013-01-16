<!-- start of news -->
<?php if(!empty($news)) : ?>
<div class="grey">
	<div class="container">
		<div class="row module news">
			<div class="span14">
				<h2>
					<a href="#">News</a>
				</h2>
				<div class="row">
				<?php foreach($news as $new) : ?>
					<div class="span3 story">
						<a href="#">
						<div><img src="<?php echo base_url()."assets/images/".$new->img_url;?>" alt="Supernova"></div>
						<h3><div><?php echo $new->title; ?></div></h3>
						</a>
					</div>
				<?php endforeach; ?>
					
				<div class="span4 headlines">
				<?php foreach($latest_news as $latest_new) : ?>
					<h3><a href="#">Latest News</a></h3>
					<div id="newsrotate">
						<ul class="unstyled" style="width: 100%; height: 100%; position: relative;">
							<li>
								<a href="#"><?php echo $latest_new->content; ?></a>
							</li>
						</ul>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php else : ?>
<div class="grey">
	<div class="container">
		<div class="row module news">
			<div class="span14">
				<h2>
					<a href="#">News</a>
				</h2>
				<div class="row">
				<div class="span3 story">
					<a href="#">
					<div><img src="http://news.uchicago.edu/sites/all/files/imagecache/news_module_regular/images/newsmodule/20121214.btqznlxywa1473020121214.jpeg" alt="Supernova"></div>
					<h3><div>Study questions whether exploding star formed solar system</div></h3>
					</a>
				</div>
				
				<div class="span3 story">
					<a href="#">
					<div><img src="http://news.uchicago.edu/sites/all/files/imagecache/news_module_regular/images/newsmodule/20121214.pxiqlweosn1473120121214.jpeg" alt="Fed presidents"></div>
					<h3><div>Students discuss economy with Fed officials at Becker Friedman Institute</div></h3>
					</a>
				</div>
				
				<div class="span3 story">
					<a href="#">
					<div><img src="http://news.uchicago.edu/sites/all/files/imagecache/news_module_regular/images/newsmodule/20121214.indianajonesmystery-copy2.jpg" alt="Indiana Jones"></div>
					<h3><div>College Admissions fields an 'Indiana Jones' mystery</div></h3>
					</a>
				</div>
				
				<div class="span4 headlines">
					<h3><a href="#">Latest News</a></h3>
					<div id="newsrotate">
						<ul class="unstyled" style="width: 100%; height: 100%; position: relative;">
							<li>
								<a href="">This is just a test news post. This is just a test news post. This is just a test news post. This is just a test news post.</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php endif; ?>
<!-- end of news -->