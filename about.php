<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$bread = 'about';
	include 'inc/header.php';
	?>
		
		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="section-row">
							<p>Hello !! I am Roman Shilpakar. I am studying Bachelor in Computer Engineering at Khwopa Colege Of Engineering. This dynamic website is an outcome of the 15th days online training of PHP organized by Khwopa Colege Of Engineering. </p>
							<figure class="figure-img">
								<img class="img-responsive" src="assets/img/cover.jpg" alt="">
							</figure>
							<p>This website is a blog website where you can get latest news, information and update from different category like games ,WWE , world news , PYTHON , JAVA etc.</p>
						</div>
						<div class="row section-row">
							<div class="col-md-6">
								<figure class="figure-img">
									<img class="img-responsive" src="assets/img/mission.jpg" alt="">
								</figure>
							</div>
							<div class="col-md-6">
								<h3>MY Mission</h3>
								<p>Well my mission for the wesites are: </p>
								<ul class="list-style">
									<li><p>Collect latest news from around the world.</p></li>
									<li><p>Present various project using programnming language like JAVA PYTHON etc.</p></li>
									<li><p>Make aware about events and storylines of WWE weekly</p></li>
									<li><p>Latest news from GAMING world.</p></li>
								</ul>
							</div>
						</div>
					</div>
					
					<!-- aside -->
					<div class="col-md-4">
						<!-- ad -->
						
						<?php 
									$Ad = new advertisement();
									$recentAd=$Ad->getLatestAdByType('Simple');
									if (isset($recentAd[0]) && !empty($recentAd[0])) {
										//checking if the image exists or not
										if (isset($recentAd[0]->image) && !empty($recentAd[0]->image) && file_exists(UPLOAD_PATH.'advertisement/'.$recentAd[0]->image)) {
											$thumbnail = UPLOAD_URL.'advertisement/'.$recentAd[0]->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimage.png';
										}
								    ?>
					<a href="<?php echo($recentAd[0]->url) ?>"><img class="img-responsive center-block"
							style="width:300px;height:250px" src="<?php echo($thumbnail); ?>" alt=""></a>
					<?php 
									}
									?>
						<!-- /ad -->

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							
								<?php 
							$BLog = new blog();
								$popularBlog = $Blog->getAllPopularBlogsWithLimit(0,8);
								if ($popularBlog) {
									foreach ($popularBlog as $key => $blog) {
										if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog/'.$blog->image)) {
											$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimage.png';
										}
							?>
					<div class="post post-widget">
						<a class="post-img" href="blog-post?id=<?php echo $blog->id ?>"><img
								src="<?php echo($thumbnail); ?>" class="img-responsive"></a>
						<div class="post-body">
							<h3 class="post-title"><a
									href="blog-post?id=<?php echo $blog->id ?>"><?php echo $blog->title; ?></a></h3>
						</div>
					</div>

					<?php
									}
								}
							?>

						</div>
						<!-- /post widget -->
					</div>
					<!-- /aside -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

	

		<?php
		include 'inc/footer.php';
		?>