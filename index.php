<?php
	session_start();
	require_once './include/db.php';
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	};

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
	<link rel="stylesheet" href="css/connection_status.css">
	<!-- -----------------------------------jquery menu-------------------------------------- -->
	<script src="js/jquery-1.8.0.min.js" type="text/javascript"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<title>Ebook</title>
</head>

<body>
	<div class="page-loader">
		<div class="loading-page-animetion">
		</div>
	</div>
	<div class="all-content <?=$content_visible?>" style="display: none">
		<div class="container">
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
                                    <a class="nav-link active" aria-current="page" href="./index"><i class="fa-solid fa-house-chimney"></i></a>
                                </li>
                                <?php
                                try {
                                    $menu = $db->prepare("SELECT * FROM menu");
                                    $menu->execute();
                                    $posts = $menu->fetchAll(PDO::FETCH_CLASS);
                                    foreach ($posts as $post) {
                                        ?>
                                            <li class="nav-item"><a class="nav-link" title="<?= $post->title ?>" href='./type.php?category=<?= $post->url ?>'><span><?= $post->name ?></span></a></li>
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
				<div class="col-xxl-8 col-xl-8 col-md-12 col-sm-12 col-12">
					<!-- -------------------------------end new content--------------------------------------- -->
					<div class="row" style="margin-bottom: 25px">
						<?php
						if (isset($_GET['search'])) {
							$keyword = $_GET['search'];
							$postQuery = "SELECT * FROM book WHERE title LIKE '%$keyword%' ORDER BY id DESC";
							$dsplay = "none";
						} else {
							$postQuery = "SELECT * FROM book ORDER BY id DESC LIMIT $result_page,$post_per_page";
						}
						try {
							$runPQ = $db->prepare($postQuery);
							$runPQ->execute();
							$posts = $runPQ->fetchAll(PDO::FETCH_CLASS); 
							$getpage = $db->prepare("SELECT * FROM book");
							$getpage->execute();
							$total_post = $getpage->rowCount();
							$total_pages = ceil($total_post / $post_per_page);
							foreach($posts as $post) {
							?>
								<div class="col-xxl-3 col-xl-3 col-md-3 col-sm-6 col-6">
									<div class="movie_image">
										<img alt="<?= $post->title?>" data-id="<?= $post->id?>" class="img js-img-<?= $post->id?>" src="./images/book/<?=$post->image?>" />
										<div class="view-detial">
											<a title="<?=$post->title?>" href="description?id=<?= $post->id?>"><button>View</button> </a>
										</div>
									</div>
									<div class="movie_title_1">
										<span>
											<?= $post->title?>
										</span><br />
										<span style="color:#3c763d;">
											<?=$post->view?> &nbsp;<i class="fa-solid fa-eye"></i>
										</span>
									</div>
								</div>
							<?php
							}
						} catch (Exception $e) {
							echo $e->getMessage();
						}
						
						?>
					</div>
					<!-- -------------------------------end new content--------------------------------------- -->


				</div>
				<!-- -----------------------------end left-------------------------------------------- -->
				<div class="col-xxl-4 col-xl-4 col-md-12 col-12 most-view">
					<?php
						include 'include/right_content.php';
					?>
				</div>
				<?php
					include 'include/pagination.php';
				?>
			</div>

		</div>
		<!-- -------------------------end content-------------------------------------------------- -->

		<!-- Connection Status Alert -->
		<div class="connection-status-wrapper">
			<div class="alert alert-primary align-items-center" id="alert-js" role="alert">
				<i class="fa-solid fa-wifi mx-3"></i>
				<div id="status">
				</div>
			</div>
		</div>
		<!-- End Connection Status Alert -->
	</div>

	<div class="construction_mode" style="display:<?=$construction_visible?>">
		<img src="./images/banner.png" alt="">
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="js/script.js"></script>
	<script src="js/connection_status.js"></script>
	<script>
		const url = window.location.href;
		let newurl = url.split('/');
		console.log(newurl[4]);
		if(newurl[4] == "?search="){
			window.location.href = "http://localhost/seavphov/";
		}

	</script>
</body>

</html>