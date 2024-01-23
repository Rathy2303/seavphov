<?php
include 'include/db.php';
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
    <!-- -----------------------------------end jquery menu-------------------------------------- -->
</head>

<body>
    <div id="main_content">
        <div id="main_content1">
            <div class="wrap">
                <?php
                include 'include/header.php';
                ?>
                <div class="menu">
                    <div id='cssmenu'>
                        <ul>
                            <li><a href='./index.php' class=""><span>Home</span></a></li>
                            <?php
                            $menu = "SELECT * FROM menu";
                            $runPQ = mysqli_query($db, $menu);
                            while ($post = mysqli_fetch_assoc($runPQ)) {
                                if ($post['url'] == $category) {
                            ?>
                                    <li><a title="<?= $post['title'] ?>" class="active" href='./type.php?category=<?= $post['url'] ?>'><span><?= $post['name'] ?></span></a></li>

                                <?php
                                } else {
                                ?>
                                    <li><a title="<?= $post['title'] ?>" href='./type.php?category=<?= $post['url'] ?>'><span><?= $post['name'] ?></span></a></li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- -------------------------ad-------------------------------------------------- -->
            <div class="wrap">
            </div>
            <div class="wrap">
                <!-- ---------------------------left-------------------------------------------------- -->
                <div class="left">
                    <div class="content_title">
                        <h4><?= strtoupper($category) ?></h4>
                    </div>
                    <div class="New_content_1">
                        <?php
                        if (isset($_GET['search'])) {
                            $search =  $_POST['search'];
                            $book = mysqli_query($db, "SELECT book.id,book.view,book.title,book.image FROM book INNER JOIN category ON book.category_id = category.id WHERE category.name='$category' AND book.title LIKE '%$search%' ORDER BY id DESC LIMIT $result,$post_per_page");
                        } else
                            $book = mysqli_query($db, "SELECT book.id,book.view,book.title,book.image FROM book INNER JOIN category ON book.category_id = category.id WHERE category.name='$category' ORDER BY id DESC LIMIT $result,$post_per_page");

                        while ($row = mysqli_fetch_assoc($book)) {
                        ?>
                            <!-- ------movie -------- -->
                            <div class="movie_1 center">
                                <div class="movie_image">
                                    <img alt="<?= $row['title'] ?>" src="images/book/<?= $row['image'] ?>" />
                                    <div class="view-detial">
                                        <a title="<?= $row['title'] ?>" href="description.php?id=<?= $row['id'] ?>"><button>View</button> </a>

                                    </div>
                                </div>
                                <div class="movie_title_1">
                                    <span><?= $row['title'] ?></span><br />
                                    <span style="color:#3c763d"><?= $row['view'] ?>&nbsp;<i class="fa-solid fa-eye"></i></span>
                                </div>

                            </div>
                            <!-- ------end movie -------- -->
                        <?php
                        }
                        // -- ORDER BY id DESC LIMIT $result,$post_per_page"
                        // $prun = mysqli_query($db, $pquery);
                        $getpage = mysqli_query($db, "SELECT*FROM book WHERE category_id=1");
                        $total_post = mysqli_num_rows($getpage);
                        $total_pages = ceil($total_post / $post_per_page);
                        ?>
                    </div>

                    <!-- pagination -->
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

                    <!-- pagination -->

                    <!-- -------------------------------new content_1--------------------------------------- -->

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
                    <!-- Search Bar -->
                    <div class="right_content">
                        <form class="form-wrapper cf" action="?category=<?= $category ?>&search" method="post">
                            <input type="text" class="search" id="searchid" name="search" placeholder="Search here..." />
                            <button type="submit">Search</button>
                            <br />
                            <div id="result">
                        </form>
                    </div>
                    <?php
                    include 'include/right_content.php';
                    ?>
                </div>
            </div>
            <?php
            include 'include/footer.php';
            include 'include/gotop.php';
            ?>
        </div>
    </div>
</body>
</html>