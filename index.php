<?php
include 'include/db.php';
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
};
$post_per_page = 12;
$result_page = ($page - 1) * $post_per_page;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-Z68Y7D90TL"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'G-Z68Y7D90TL');
	</script>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6423415704245718" crossorigin="anonymous"></script>
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta name="Keywords" content="HTML5,CSS,JAVASCRIPT,PHP,SQL,Java,Web development,Computer Lesson,Math,For Read,Programming,Networking,Template">
	<meta name="Description" content="We are building tutorials with lots of examples of how to use HTML, CSS, JavaScript, SQL, PHP, Bootstrap, Java and XML Or Sql Server">
	<title>Seav Phov - Free PDF Book</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/mainstyle.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="kh.png" />
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<!-- -----------------------------------jquery menu-------------------------------------- -->
	<script src="js/jquery-1.8.0.min.js" type="text/javascript"></script>
	<title>Ebook</title>
</head>

<body>
	<div class="page-loader">
		<div class="loading-page-animetion">

		</div>
	</div>
	<div class="all-content" style="display: none;">
		<div id="main_content">
			<div id="main_content1">
				<div class="wrap">

					<?php
					include 'include/header.php';
					?>
					<div class="menu">
						<div id='cssmenu'>
							<ul>
								<li><a href=''class="active"><span>Home</span></a></li>
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
				<!-- -------------------------content-------------------------------------------------- -->
				<div class="wrap">
					<!-- ---------------------------left-------------------------------------------------- -->
					<div class="left">

						<!-- -------------------------------end new content--------------------------------------- -->
						<div class="New_content_1" style="margin-bottom: 25px">
							<?php
							if (isset($_GET['search'])) {
								$keyword = $_GET['search'];
								$postQuery = "SELECT * FROM book WHERE title LIKE '%$keyword%' ORDER BY id DESC";
								$dsplay = "none";
							} else {
								$postQuery = "SELECT * FROM book ORDER BY id DESC LIMIT $result_page,$post_per_page";
							}

							$runPQ = mysqli_query($db, $postQuery);
							$getpage = mysqli_query($db, "SELECT * FROM book");
							$total_post = mysqli_num_rows($getpage);
							$total_pages = ceil($total_post / $post_per_page);

							while ($post = mysqli_fetch_assoc($runPQ)) {
							?>
								<div class="movie_1 center">

									<div class="movie_image">
										<img alt="<?= $post['title'] ?>" data-id="<?= $post['id'] ?>" class="img js-img-<?= $post['id'] ?>" src="images/book/<?= $post['image'] ?>" />
										<div class="view-detial">
											<a title="<?= $post['title'] ?>" href="description.php?id=<?= $post['id'] ?>"><button>View</button> </a>
										</div>
										<div class="img-loader-box js-img-loader-<?= $post['id'] ?>" style="	display: flex;">
											<div class="img-loader">

											</div>
										</div>
									</div>
									<div class="movie_title_1">
										<span>
											<?= $post['title'] ?>
										</span><br />
										<span style="color:#3c763d;">
											<?= $post['view'] ?> &nbsp;<i class="fa-solid fa-eye"></i>
										</span>
									</div>
								</div>
							<?php
							}
							?>
						</div>
						<!-- -------------------------------end new content--------------------------------------- -->
						<?php
						include 'include/pagination.php';
						?>

					</div>

				</div>
				<!-- -----------------------------end left-------------------------------------------- -->
				<div class="right">
					<style type="text/css">
						.content {
							width: 900px;
							margin: 0 auto;
						}

						#searchid {
							font-size: 14px;
							padding-left: 10px;
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
	</div>

	<script src="js/script.js"></script>
</body>

</html>