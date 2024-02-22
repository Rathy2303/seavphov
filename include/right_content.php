<div class="right_content">
    <div class="right_content_title">
        <h4>Most Views</h4>
    </div>
    <div class="right_content_detail">
        <?php
        $postQuery = "SELECT * FROM book ORDER BY view DESC LIMIT 12";
        $runPQ = mysqli_query($db, $postQuery);
        while ($post = mysqli_fetch_assoc($runPQ)) {
        ?>
            <div class="new_movie">
                <a title="<?= $post['title'] ?>" href="description.php?id=<?= $post['id'] ?>">
                    <img alt="<?= $post['title'] ?>" src="../include/display_img.php?id=<?=$post['id']?>" />
                    <span>
                        <?= $post['title'] ?>
                    </span>
                    <br />
                    <span style="color:#3c763d;">
                        <?= $post['view'] ?> &nbsp;<i class="fa-solid fa-eye"></i>
                    </span>
                </a>
            </div>
       <?php
        }
        ?>
    </div>
</div>