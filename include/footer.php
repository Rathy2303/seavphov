<div class="wrap">
			<div class="footer">
                <?php
                date_default_timezone_set('Asia/Phnom_Penh');
                $date = date('D/d/M/Y', time());
                  ?>

                    <h1 style="text-align: center;font-size:18px">Copyright©2023 - <?=$date?> <a href="index.php" style="text-decoration: none">Seav Phov</a>&nbsp;&nbsp;&nbsp;<a href="" onclick="donateABA()">Donate</a></h1>
                  <?php
                ?>
			</div>
		</div>

    <script>
function donateABA() {
  var myWindow = window.open("https://link.payway.com.kh/ABAPAYxY178319M","", "width=800,height=1000,");
}
</script>