<?php
include 'include/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from mengheang.com/description.php?movies=105 by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Sep 2023 12:04:49 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
	<script src="js/script.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<meta charset="UTF-8">
	<meta content="you can study with our tutorials like Switch multiple languages in database" name='description' />
	<link rel="shortcut icon" href="kh.png" />
	<meta name="title" content="Ajax Programming" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/post-img.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--<link rel="stylesheet" type="text/css" href="http:///css/stylesheet.css" />-->
	<!--- Facebook Meta Key --->
	<!--- Facebook Meta Key --->
	<?php
	$post_id = $_GET['id'];
	$postQuery = "SELECT * FROM book WHERE id=$post_id";
	$runPQ = mysqli_query($db, $postQuery);
	$post = mysqli_fetch_assoc($runPQ);
	?>
	<title>
		<?= $post['title'] ?>
	</title>
	<?php

	?>
	<link href="css/mainstyle.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" href="css/btn.css">
	<!-- -----------------------------------jquery menu-------------------------------------- -->
</head>

<body class="video-watch videoid-4772 author-1 source-0 featured">
	<!-- Facebook Share button -->
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="../connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>
	<!-- Facebook Share button -->
	<div id="main_content">
		<div id="main_content1">
			<div class="wrap">
				<?php
				include 'include/header.php';
				?>
				<div class="menu">
						<div id='cssmenu'>
							<ul>
								<li><a href='./index.php'class="active"><span>Home</span></a></li>
								<?php
								$menu = "SELECT * FROM menu";
								$runPQ = mysqli_query($db, $menu);
								while ($post = mysqli_fetch_assoc($runPQ)) {
								?>
									<li><a title="<?= $post['title'] ?>" href='./type.php?category=<?= $post['url'] ?>'><span><?= $post['name'] ?></span></a></li>
								<?php
								}
								?>

							</ul>
						</div>

					</div>

			</div>
			<!-- -------------------------ad-------------------------------------------------- -->
			<div class="wrap">
				<!--	<div class="ad_left"></div>
			<div class="ad_right"></div>-->
			</div>
			<!-- -------------------------end ad-------------------------------------------------- -->
			<!-- -------------------------content-------------------------------------------------- -->
			<div class="wrap">
				<!-- ---------------------------left-------------------------------------------------- -->
				<div class="left">

					<!-- -------------------------------end new content--------------------------------------- -->


					<div class="movie_des">
						<?php
						$post_id = $_GET['id'];
						mysqli_query($db, "UPDATE book SET view=view+1 WHERE id=$post_id");
						$postQuery = "SELECT * FROM book WHERE id=$post_id";
						$runPQ = mysqli_query($db, $postQuery);
						$post = mysqli_fetch_assoc($runPQ);
						?>
						<div style="width:100%; background:#0075B0; margin-top:-12px;">
							<h1 style="margin-left:10px; font-size:18px;padding:10px 0;color:white;">
								<?= $post['title'] ?>
							</h1>
						</div>

						<img src="images/book/<?= $post['image'] ?>" alt="<?= $post['title'] ?>" style="margin-left:10px;border-radius: 10px;width:300px;height:263px;object-fit: cover" />

						<div class="des">
							<input type="hidden" id="downloadid" name="downloadid" value="105" />


							<p style="padding:0; margin:0;float:left; font-size:15px"><strong>Title : </strong></p>
							<h4 style="padding:0; margin:0; font-size:15px">&nbsp; <?= $post['title'] ?></h4>

							<p style="padding:0; margin-top: 5px; font-size:14px">
								<strong>Views : </strong> <b style="color: #b84c4c;">
									<?= $post['view'] ?>&ensp;Times
								</b>
							</p>

							<p style="padding:0; margin:0;font-size:14px">
								<strong>Downloaded : </strong>
								<?= $post['download'] ?>
							</p>
							<br>
							<a class="download_id" href="include/download.php?id=<?= $post['id'] ?>" target="_blank">
								<!-- <img style="float:left" src="images/download.jpg" width="150" /> -->
								<button class="button-50" role="button">Download</button>
							</a>
								
							<div style="margin-top: -10px;">
							</div>
						</div>

						<?php

						?>



					</div>


					<div class="content_title">
						<h4>Related Books</h4>
					</div>
					<div class="New_content_1">

						<!-- ------movie -------- -->

						<?php
						$pquery = "SELECT*FROM book WHERE category_id={$post['category_id']} ORDER BY id DESC LIMIT 7";
						$prun = mysqli_query($db, $pquery);
						while ($rpost = mysqli_fetch_assoc($prun)) {
							if ($rpost['id'] == $post_id) {
								continue;
							}
						?>
							<div class="movie_1 center">
								<a href="description.php?id=<?= $rpost['id'] ?>">
									<div class="movie_image">
										<img alt="<?= $rpost['title'] ?>" src="images/book/<?= $rpost['image'] ?>" />
									</div>
									<div class="movie_title_1">
										<span>
											<?= $rpost['title'] ?>
										</span><br />
										<span style="color:#3c763d">
											<?= $rpost['view'] ?>&nbsp;<i class="fa-solid fa-eye"></i>
										</span>
									</div>
								</a>
							</div>
							<!-- ------end movie -------- -->

						<?php
						}
						?>

					</div>


					<!-- -------------------------------new content_1--------------------------------------- -->

				</div>
				<!-- -----------------------------end left-------------------------------------------- -->
				<div class="right">
					<!-- ------------------search ------------------------ -->


					<style type="text/css">
						.content {
							width: 900px;
							margin: 0 auto;
						}

						#searchid {
							font-size: 14px;
						}

						#result {
							background-color: white;
							border: 1px solid #ccc;
							border-radius: 5px;
							display: none;
							margin-top: 18px;
							overflow: hidden;
							padding: 10px;
							position: absolute;
							width: 277px;
						}

						.show {
							padding: 10px;
							border-bottom: 1px #999 dashed;
							font-size: 15px;
							height: 50px;
						}

						.show:hover {
							background: #4c66a4;
							color: #FFF;
							cursor: pointer;
						}
					</style>

					<?php
					include 'include/searchbar.php';
					include 'include/right_content.php';
					?>
				</div>
			</div>

		</div>
		<!-- -------------------------end content-------------------------------------------------- -->

		<?php
		include 'include/footer.php';
		include 'include/gotop.php';
		?>
	</div>
	</div>
</body>


</html>