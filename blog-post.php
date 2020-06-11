<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$blog_id = (int)$_GET['id'];
		if ($blog_id) {
			$Blog = new blog();
			$blog_info = $Blog->getBlogbyId($blog_id);
			if ($blog_info) {
				$blog_info= $blog_info[0];
				$data=array(
					'view' => $blog_info->view + 1
				);
				$Blog->updateBlogById($data,$blog_id);
			}else{
				redirect('index');
			}
		}else{
			redirect('index');
		}
	}else{
		redirect('index');
	}
	
	include 'inc/header.php';
	?>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Post content -->
					<div class="col-md-8">
						<div class="section-row sticky-container">
							<div class="main-post">
							<?php echo html_entity_decode($blog_info->content); ?>
							</div>

							
							
							
							
							<!-- Share butttons -->
							   <h3>Share</h3>
                               <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                               <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                               <a class="a2a_button_facebook"></a>
                               <a class="a2a_button_twitter"></a>
                               <a class="a2a_button_email"></a>
                               </div>
                               <script async src="https://static.addtoany.com/menu/page.js"></script>
                               <!-- Share butttons -->

							

							 
						</div>

						<!-- ad -->
						<div class="section-row">
					
					<?php 
									$Ad = new advertisement();
									$recentAd=$Ad->getLatestAdByType('Wide');
									if (isset($recentAd[0]) && !empty($recentAd[0])) {
										//checking if the image exists or not
										if (isset($recentAd[0]->image) && !empty($recentAd[0]->image) && file_exists(UPLOAD_PATH.'advertisement/'.$recentAd[0]->image)) {
											$thumbnail = UPLOAD_URL.'advertisement/'.$recentAd[0]->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimage.png';
										}
								    ?>
					<a href="<?php echo($recentAd[0]->url) ?>" style="display: inline-block;margin: auto;"><img
							class="img-responsive center-block" style="width:728px;height:90px"
							src="<?php echo($thumbnail); ?>" alt=""></a>
					<?php 
									}
									?>
				</div>
						<!-- ad -->
						
						<!-- author -->
						<div class="section-row">
							<div class="post-author">
								<div class="media">
									<div class="media-left">
										<img class="media-object" src="assets/img/roman.jpeg" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h3>Roman Shilpakar</h3>
										</div>
										<p>Helo i am Roman Shilpakar. I created this website as a part of training conducted by my college. In this website, you'll get information, blogs and news relating WWE, Python, Java, My Youtube channel , Games and Worlds News</p>
										<ul class="author-social">
										<?php
						$Icon = new info();
						$icons = $Icon->getAllInfo();
						if ($icons) {
							foreach ($icons as $key => $icon) {
						?>
								<li><a href="<?php echo $icon->url?>"><i class="<?php echo $icon->class?>"></i></a></li>
						<?php
							}
						}
						?>

										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- /author -->

						<!-- comments -->
						<div class="section-row">
							<div class="section-title">
								<h2>
									<?php 
										$Comment = new comment(); 
										$count=$Comment->getNumberCommentByBlog($blog_id);
										echo $count[0]->total;
									?>
									Comments
								</h2>
							</div>

							<div class="post-comments">
								

								<?php 
									$comments = $Comment->getAllAcceptCommentByBlog($blog_id);
									if ($comments) {
										foreach ($comments as $key => $comment) {
								?>
								<!-- comment -->
								<div class="media">
									<div class="media-left">
										<img class="media-object" src="./assets/img/avatar.png" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h4><?php echo $comment->name; ?></h4>
											<span class="time"><?php echo date("M d, Y h:i:s a",strtotime($comment->created_date)); ?></span>
											<a href="#ReplySection" class="reply" onclick="comment(this);" data-commentID="<?php echo ($comment->id) ?>">Reply</a>
										</div>
										<p><?php echo html_entity_decode($comment->message); ?></p>

										<?php 
											$replies=$Comment->getAllAcceptReplyByBlogByComment($blog_id,$comment->id);
											if ($replies) {
												foreach ($replies as $key => $reply) {
										?>
										<!-- reply -->
										<div class="media">
											<div class="media-left">
												<img class="media-object" src="./assets/img/avatar.png" alt="">
											</div>
											<div class="media-body">
												<div class="media-heading">
													<h4><?php echo $reply->name; ?></h4>
													<span class="time"><?php echo date('M d, Y h:i:s a',strtotime($reply->created_date)); ?></span>
													<a href="#ReplySection" class="reply" onclick="comment(this);" data-commentID="<?php echo ($comment->id) ?>">Reply</a>
												</div>
												<p><?php echo $reply->message; ?></p>
											</div>
										</div>
										<!-- /reply -->
										<?php
												}
											}

										?>
										
									</div>
								</div>
								<!-- /comment -->
								<?php
										}
									}
								?>
								
							</div>
						</div>
						<!-- /comments -->

						<!-- reply -->
						<div class="section-row" id="ReplySection">
							<div class="section-title">
								<h2>Leave a reply</h2>
								<p>your email address will not be published. required fields are marked *</p>
							</div>
							<form class="post-reply" action="process/comment" method="post">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<span>Name *</span>
											<input class="input" type="text" name="name">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span>Email *</span>
											<input class="input" type="email" name="email">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span>Website</span>
											<input class="input" type="text" name="website">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="input" name="message" placeholder="Message"></textarea>
										</div>
										<input type="hidden" name="commentid" id="comment_id" value="">
										<input type="hidden" name="blogid" value="<?php echo($blog_id) ?>">
										<button class="primary-button" type="submit">Submit</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /reply -->
					</div>
					<!-- /Post content -->

					<!-- aside -->
					<div class="col-md-4">
				<!-- simple ad -->
				<div class="aside-widget text-center">
					
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
					<a href="<?php echo($recentAd[0]->url) ?>" style="display: inline-block;margin: auto;"><img
							class="img-responsive center-block" style="width:300px;height:250px"
							src="<?php echo($thumbnail); ?>" alt=""></a>
					<?php 
									}
									?>
				</div>
						<!-- /ad -->

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
							<h2>Most Read</h2>
					</div>

					<?php 
								$popularBlog = $Blog->getAllPopularBlogByCategoryWithLimit($blog_info->categoryid,0,4);
								if ($popularBlog) {
									foreach ($popularBlog as $key => $blog) {
										if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog/'.$blog->image)) {
											$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimg.jpg';
										}
							?>
					<div class="post post-widget">
						<a class="post-img" href="blog-post?id=<?php echo $blog->id ?>"><img
								src="<?php echo($thumbnail); ?>" alt=""></a>
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

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Featured Posts</h2>
							</div>
							<?php 
						        $Blog = new blog();
								$recentBlog = $Blog->getAllFeaturedBlogByCategoryWithLimit($blog_info->categoryid,0,2);
								if ($recentBlog) {
									foreach ($recentBlog as $key => $blog) {
										if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog/'.$blog->image)) {
											$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimage.png';
										}
							?>
					<!-- post -->

					<div class="post post-thumb">

						<a class="post-img" href="blog-post?id=<?php echo $blog->id ?>"><img
								src="<?php echo($thumbnail); ?>" class="img-responsive" style="height:300px;"></a>
						<div class="post-body">
							<!-- for date with category name -->
							<div class="post-meta">
								<a class="post-category <?php echo CAT_COLOR[$blog->categoryid%4] ?>"
									href="category?id=<?php echo $blog->categoryid ?>"><?php echo $blog->category; ?></a>
								<!-- error ingetting name of category -->
								<span
									class="post-date"><?php echo date("M d, Y",strtotime($blog->created_date)); ?></span>
							</div>
							<h3 class="post-title"><a
									href="blog-post?id=<?php echo $blog->id ?>"><?php echo $blog->title; ?></a></h3>

						</div>
					</div>
					<!-- /post -->
					<?php
									}
								}
							?>
						<!-- /post widget -->
						
						<!-- catagories -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Catagories</h2>
							</div>
							<div class="category-widget">
							<ul>
								<?php 
										if ($categories) {
											foreach ($categories as $key => $category) {
									?>
								<li><a href="category?id=<?php echo $category->id ?>"
										class="<?php echo CAT_COLOR[$category->id%4] ?>"><?php echo($category->categoryname) ?><span>
											<?php 
										//to get count of no of posts
											$Count = $Blog->getNumberBlogByCategory($category->id);
											echo $Count[0]->total;
										?>
										</span></a></li>
								<?php
											}
										}
									?>

							</ul>
						
							</div>
						</div>
						<!-- /catagories -->
						
						<!-- tags -->
						<div class="aside-widget">
							<div class="tags-widget">
							<ul>
								<?php 
								#to update categories dynamically 
									$Category = new category();
									$categories = $Category->getAllCategory();
									if ($categories) {
										foreach ($categories as $key => $category) {
								?>

								<li><a
										href="category?id=<?php echo $category->id ?>"><?php echo $category->categoryname; ?></a>
								</li>
								<?php
										}
									}
								?>

							</ul>
							</div>
						</div>
						<!-- /tags -->
						
						<!-- archive -->
						<div class="aside-widget">
						<div class="section-title">
							<h2>Archive</h2>
						</div>
						<div class="archive-widget">
							<ul>
								<?php 
										$Archive = new archive();
										$archives = $Archive->getAllArchive();
										if ($archives) {
											foreach ($archives as $key => $archive) {
									?>
								<li><a
										href="archive?id=<?php echo $archive->id ?>"><?php echo date('M d, Y',strtotime($archive->date)); ?></a>
								</li>
								<?php
											}
										}
									?>
							</ul>
						</div>
					</div>
						<!-- /archive -->
					</div>
					<!-- /aside -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<?php include 'inc/footer.php';; ?>
		<script>
			

			function comment(element){
				var id = $(element).data();
				console.log(id.commentid);
				$('#comment_id').val(id.commentid);
			}
		</script>
	