<div class="pagination_center" style="margin: auto;margin-bottom: 20px">
    <div class="pagination">
    <?php
       if($page>1)
       {
         $switch="";
       }else{
         $switch="diable_page";
       }
       if($page<$total_pages)
       {
         $nswitch="";
       }else{
         $nswitch="diable_page";
       }
    ?>
    <a href="?page=<?=$page-1?>" class="<?=$switch?>">&laquo;</a>
     <?php
            $c="active page";
            $count=1;
            for($opage=1;$opage<=$total_pages;$opage++){
              if($page==$count){
                $c="active page";
              }else
                $c="";
              ?>
              <a href="?<?php if(isset($_GET['search'])){echo "search=$keyword&";}?>page=<?=$count?>" class="<?=$c?>"><?=$count?></a>
              <!-- <a href="?page=<?=$opage+1?>" class="<?=$c?>"><?=$opage+1?></a> -->
              <?php
              $count++;
            }
            ?>
            <a href="?page=<?=$page+1?>" class="<?=$nswitch?>">&raquo;</a>
  </div>
  
</div>