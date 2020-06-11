<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$bread = 'contact';
	include 'inc/header.php';
	?>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-6">
						<div class="section-row">
							<h3>Contact Information</h3>
							<p>For any complain or message, You can contact here.</p>
							<ul class="list-style">
								<li><p><strong>Email:</strong> <a href="#">iamromanshilpakar@gmail.com</a></p></li>
								<li><p><strong>Phone:</strong> +9779840123110</p></li>
								<li><p><strong>Address:</strong> khauma, bhaktapur, nepal</p></li>
							</ul>
						</div>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<div class="section-row">
							<h3>Send A Message</h3>
							<form action="process/contactmessage" method="post">
							<div class="row">
									<div class="col-md-7">
										<div class="form-group">
											<span>Email</span>
											<input class="input" type="email" name="email" required="">
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<span>Subject</span>
											<input class="input" type="text" name="subject" required="">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="input" name="message" placeholder="Message" required=""></textarea>
										</div>
										<input type="hidden" name="contactmessageid" id="contactmessage_id" value="">
										<button class="primary-button" type="submit">Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<?php
		include 'inc/footer.php';
		?>