<?php
use App\Helpers\Navigate;

?>
    <div class="nick fs40 bold"> Добро пожаловать, 
        <?php echo $data['user']['name'] ?: "Не установлено" ?>
    </div>
<main>
    <div class="links_wrapper">
        <h2 class="mb8">Ваши ссылки</h2>
        <div class="links">
        <?php
            
            foreach ($data['links'] as $link) {
                
               echo "<p id='" . $link['id']. "' class='link fs16 mb8' data-tooltip='" . $link['long_link'] . "' >" .  Navigate::link('L', mode:"return") .
                  '?s=' .$link['short_link'] .
                "<button onclick='delete_link(". $link['id'] . ',' . '"' . $link['short_link']. '"' .")' class='del_link' >❌</button> </p>";
              
           } 
           
           ?>
            </div>
    </div>
</main>
<form action="" method="post">

</form>
    <a id="exit" class="fs24" href="<?php Navigate::middleware("users/logout") ?>">Выход</a>