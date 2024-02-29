<?php
include 'include/db.php';
	$content_visible = "block";
	$construction_visible = "none";
	try {
		$myfile = fopen("site_config.txt",'r');
		$status = fread($myfile,filesize("site_config.txt"));
		fclose($myfile);
		if($status == "site_contruction = true")
		{
			$construction_visible = "block";
			$content_visible = "hide_content";
		}
	} catch (Exception $e) {
		echo $e;
	}
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
	try {
		$title = $db->prepare("SELECT title FROM book WHERE id=?");
		$title->execute([$post_id]);
		$post = $title->fetch();
	?>
		<title>
			<?= $post['title'] ?>
		</title>
	<?php
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	?>
	<link href="css/mainstyle.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" href="css/btn.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<!-- -----------------------------------jquery menu-------------------------------------- -->
</head>

<body>
	<div class="page-loader">
		<div class="loading-page-animetion">
		</div>
	</div>
	<div class="all-content <?= $content_visible ?>" style="display: none">
		<div class="container <?= $content_visible ?>">
			<div class="wrap">
				<?php
				include 'include/header.php';
				?>
				<nav class="navbar navbar-expand-lg" data-bs-theme="dark" style="background-color: #0075B0;">
					<div class="container-fluid">
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav me-auto mb-2 mb-lg-0">
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="./index.php">Home</a>
								</li>
								<?php
								try {
									$menu = $db->prepare("SELECT * FROM menu");
									$menu->execute();
									$result = $menu->fetchAll(PDO::FETCH_CLASS);
									foreach ($result as $row) {
								?>
										<li class="nav-item">
											<a title="<?= $row->title ?>" class="nav-link" href='./type.php?category=<?= $row->url ?>'><?= $row->name ?></a>
										</li>
								<?php
									}
								} catch (Exception $e) {
									echo $e->getMessage();
								}
								?>
							</ul>
							<form class="d-flex" role="search">
								<input class="form-control me-2 bg-light" type="text" class="search" id="searchid" name="search" placeholder="Search here..." aria-label="Search">
								<button class="btn btn-light" type="submit">Search</button>
							</form>
						</div>
					</div>
				</nav>
			</div>
			<!-- -------------------------content-------------------------------------------------- -->
			<div class="row" style="margin-top: 20px;">
				<!-- ---------------------------left-------------------------------------------------- -->
				<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12">
					<!-- -------------------------------end new content--------------------------------------- -->
					<div class="movie_des">
						<?php
						$post_id = $_GET['id'];
						try {
							$db->prepare("UPDATE book SET view=view+1 WHERE id=$post_id")->execute();
							$postQuery = $db->prepare("SELECT * FROM book WHERE id=$post_id");
							$postQuery->execute();
							$post = $postQuery->fetch();
						?>
							<div style="width:100%; background:#0075B0; margin-top:-12px;">
								<h1 style="margin-left:10px; font-size:18px;padding:10px 0;color:white;">
									<?= $post['title'] ?>
								</h1>
							</div>
							<div class="row detail-wrapper">
								<div class="col-6" style="height: 310px !important;">
									<img src="./images/book/<?= $post['image'] ?>" alt="<?= $post['title'] ?>" class="img-detail" />
								</div>
								<div class="col-6 des">
									<input type="hidden" id="downloadid" name="downloadid" value="105" />
									<p style="padding:0; margin:0;; font-size:15px"><strong>Title : </strong></p>
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
								</div>
							</div>
						<?php
						} catch (Exception $e) {
							echo $e->getMessage();
						}

						?>
					</div>
					<div class="content_title">
						<h4>Related Books</h4>
					</div>
					<div class="row">
						<!-- ------movie -------- -->
						<?php
						try {
							$pquery = $db->prepare("SELECT*FROM book WHERE category_id={$post['category_id']} ORDER BY id DESC LIMIT 7");
							$pquery->execute();
							$rposts = $pquery->fetchAll(PDO::FETCH_CLASS);
							foreach ($rposts as $rpost) {
								if ($rpost->id == $post_id) {
									continue;
								}
						?>
								<div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6">
									<a style="text-decoration: none;" href="description.php?id=<?= $rpost->id ?>">
										<div class="movie_image">
											<img alt="<?= $rpost->title ?>" src="./images/book/<?= $rpost->image ?>" />
										</div>
										<div class="movie_title_1">
											<span>
												<?= $rpost->title ?>
											</span><br />
											<span style="color:#3c763d">
												<?= $rpost->view ?>&nbsp;<i class="fa-solid fa-eye"></i>
											</span>
										</div>
									</a>
								</div>
								<!-- ------end movie -------- -->
						<?php
							}
						} catch (Exception $e) {
							echo $e->getMessage();
						}
						?>
					</div>
					<!-- -------------------------------new content_1--------------------------------------- -->
				</div>
				<!-- -----------------------------end left-------------------------------------------- -->
				<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 most-view">
					<!-- ------------------search ------------------------ -->
					<?php
					include 'include/right_content.php';
					?>
				</div>
			</div>
		</div>
		<?php
		include 'include/footer.php';
		include 'include/gotop.php';
		?>
	</div>
	</div>
	</div>

	<div class="construction_mode" style="display:<?= $construction_visible ?>">
		<img src="./images/banner.png" alt="">
	</div>
	<!-- -------------------------end content-------------------------------------------------- -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="js/script.js"></script>
</body>

</html>