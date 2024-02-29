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

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    if (isset($_GET['category'])) {
        $category =  $_GET['category'];
    }
    $post_per_page = 12;
    $result = ($page - 1) * $post_per_page;
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="kh.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Switch multiple languages in database,Upload Multiple Images in Advance Laravel,Advance Laravel CRUD Example,How to switch languages in Advance Laravel,Advance Laravel Autocomplete Search from Database,Advance Laravel JQuery Form Validation,How to Create Captcha in Advance Laravel,Ajax Pagination Advance Laravel,Laravel - Dynamically Add or Remove input fields using JQuery,Laravel Ecommerce Full Source Code Project,Basic Laravel," />
    <title><?= strtoupper($category) ?></title>
    <link href="css/mainstyle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <!-- -----------------------------------jquery menu-------------------------------------- -->
    <script src="js/jquery-1.8.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- -----------------------------------end jquery menu-------------------------------------- -->
</head>

<body>

    <div class="page-loader">
		<div class="loading-page-animetion">
		</div>
	</div>
    <div class="all-content <?= $content_visible ?>" style="display: none">
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
                                    <a class="nav-link" aria-current="page" href="./index.php">Home</a>
                                </li>
                                <?php
                                try {
                                    $menu = $db->prepare("SELECT * FROM menu");
                                    $menu->execute();
                                    $posts = $menu->fetchAll(PDO::FETCH_CLASS);
                                    foreach ($posts as $post) {
                                        if ($post->url == $category) {
                                ?>
                                            <li class="nav-item"><a class="nav-link active" title="<?= $post->title ?>" href='./type.php?category=<?= $post->url ?>'><span><?= $post->name ?></span></a></li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="nav-item"><a class="nav-link" title="<?= $post->title ?>" href='./type.php?category=<?= $post->url ?>'><span><?= $post->name ?></span></a></li>
                                <?php
                                        }
                                    }
                                } catch (Exception $e) {
                                    echo $e->getMessage();
                                }
                                ?>
                            </ul>
                            <form class="d-flex" role="search" action="?category=<?= $category ?>&search" method="post">
                                <input class="form-control me-2 bg-light" type="text" class="search" id="searchid" name="search" placeholder="Search here...">
                                <button class="btn btn-light" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- -------------------------ad-------------------------------------------------- -->
            <div class="row" style="margin-top: 20px;">
                <!-- ---------------------------left-------------------------------------------------- -->
                <div class="col-xxl-8 col-xl-8 col-lg-12 col-md-12">
                    <div class="content_title">
                        <h4><?= strtoupper($category) ?></h4>
                    </div>
                    <div class="row">
                        <?php
                        if (isset($_GET['search'])) {
                            $search =  $_POST['search'];
                            $book = "SELECT book.id,book.view,book.title,book.image FROM book INNER JOIN category ON book.category_id = category.id WHERE category.name='$category' AND book.title LIKE '%$search%' ORDER BY id DESC LIMIT $result,$post_per_page";
                        } else
                            $book = "SELECT book.id,book.view,book.title,book.image FROM book INNER JOIN category ON book.category_id = category.id WHERE category.name='$category' ORDER BY id DESC LIMIT $result,$post_per_page";
                        try {
                            $stmp = $db->prepare($book);
                            $stmp->execute();
                            $rows = $stmp->fetchAll(PDO::FETCH_CLASS);
                            foreach ($rows as $row) {
                        ?>
                                <!-- ------movie -------- -->
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
                                    <div class="movie_image">
                                        <img alt="<?= $row->title ?>" src="images/book/<?= $row->image ?>" />
                                        <div class="view-detial">
                                            <a title="<?= $row->title ?>" href="description.php?id=<?= $row->id ?>"><button>View</button> </a>

                                        </div>
                                    </div>
                                    <div class="movie_title_1">
                                        <span><?= $row->title ?></span><br />
                                        <span style="color:#3c763d"><?= $row->view ?>&nbsp;<i class="fa-solid fa-eye"></i></span>
                                    </div>

                                </div>
                                <!-- ------end movie -------- -->
                        <?php
                            }
                        } catch (Exception $e) {
                            echo $e->getMessage();
                        }
                        // -- ORDER BY id DESC LIMIT $result,$post_per_page"
                        // $prun = mysqli_query($db, $pquery);
                        $getpage = $db->prepare("SELECT*FROM book WHERE category_id=1");
                        $getpage->execute();
                        $total_post = $getpage->rowCount();
                        $total_pages = ceil($total_post / $post_per_page);
                        ?>
                    </div>
                    <!-- -------------------------------new content_1--------------------------------------- -->
                </div>
                <!-- -----------------------------end left-------------------------------------------- -->
                <div class="col-xxl-4 col-xl-4 col-lg-12 most-view">
                    <?php
                    include 'include/right_content.php';
                    ?>
                </div>
            </div>

            <div class="pagination_center">
                <div class="pagination">
                    <?php
                    if ($page > 1) {
                        $switch = "";
                    } else {
                        $switch = "diable_page";
                    }
                    if ($page < $total_pages) {
                        $nswitch = "";
                    } else {
                        $nswitch = "diable_page";
                    }
                    ?>
                    <a href="type.php?category=<?= $category ?>&page=<?= $page - 1 ?>" class="<?= $switch ?>">&laquo;</a>
                    <?php
                    $c = "active page";
                    $count = 1;
                    for ($opage = 1; $opage <= $total_pages; $opage++) {
                        if ($page == $count) {
                            $c = "active page";
                        } else
                            $c = "";
                    ?>
                        <a href="?<?php if (isset($_GET['search'])) {
                                        echo "type.php?category=$category&search=$keyword&";
                                    } ?>category=<?= $category ?>&page=<?= $count ?>" class="<?= $c ?>"><?= $count ?></a>
                        <!-- <a href="?page=<?= $opage + 1 ?>" class="<?= $c ?>"><?= $opage + 1 ?></a> -->
                    <?php
                        $count++;
                    }
                    ?>
                    <a href="type.php?category=<?= $category ?>&page=<?= $page + 1 ?>" class="<?= $nswitch ?>">&raquo;</a>
                </div>
            </div>
            <?php
            include 'include/footer.php';
            include 'include/gotop.php';
            ?>
        </div>
    </div>

    <div class="construction_mode" style="display:<?= $construction_visible ?>">
		<img src="./images/banner.png" alt="">
	</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>