<div class="right_content">
    <div class="right_content_title">
        <h4>Most Views</h4>
    </div>
    <div class="right_content_detail">
        <?php
        try {
            $postQuery = $db->prepare("SELECT * FROM book ORDER BY view DESC LIMIT 12");
            $postQuery->execute();
            $runPQ = $postQuery->fetchAll(PDO::FETCH_CLASS);
            foreach($runPQ as $post) {
            ?>
                <div class="new_movie">
                    <a title="<?=$post->title?>" href="description.php?id=<?=$post->id?>">
                        <img alt="<?= $post->title?>" src="./images/book/<?=$post->image?>" />
                        <span>
                            <?= $post->title?>
                        </span>
                        <br />
                        <span style="color:#3c763d;">
                            <?= $post->view?> &nbsp;<i class="fa-solid fa-eye"></i>
                        </span>
                    </a>
                </div>
            <?php
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        ?>
    </div>
</div>