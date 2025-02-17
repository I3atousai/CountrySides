<?php
use App\Helpers\Navigate;

?>
 <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    function set_slider(block) {
        $(block).slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
        });
    }
</script>
<script>
    let id_user=<?php echo $_SESSION['auth']['id'] ?>
</script>
<main>
    <div class="container">
        <div class="avatar_block">
            <input type="file" id="avatar_input">
            <img id="img" src="<?php Navigate::image("users/" . ($data['user']['avatar'] ?: "defolt.png")) ?>" alt="">
        </div>

        <!-- это видно всегда -->
        <div id="displayed" class="info">
            <div class="inform fs16"> <span class="info_text">Никнейм:
                    <?php echo $data['user']['name'] ?: "Не установлено" ?> </span>
            </div>
            <div class="inform fs16"> <span class="info_text">Номер телефона:
                    <?php echo $data['user']['phone'] ?: "Не установлено" ?> </span> </div>
           
            <input id="initiate_change" type="submit" value="Изменить">
        </div>

        <!-- это видно во время редактирования -->
        <form id="change_form" class="info input">
            <input id="set_name" type="text" onblur="save_changes('set_name', 'name')" class="inform fs16"
                placeholder="Никнейм: <?php echo $data['user']['name'] ?: "Не установлено" ?>">
            <input pattern="[0-9]{10,12}" id="set_phone" type="text" onblur="save_changes('set_phone', 'phone')" class="inform fs16"
                placeholder="Номер телефона: <?php echo $data['user']['phone'] ?: "Не установлено" ?>">
            <input id="submit_change" type="submit" value="Подтвердить">
        </form>

        <?php
        // echo "<pre>";
        // echo($data['user']['phone']);
        // echo "</pre>";
        
        ?>
    </div>
<h1>Посещенные туры</h1>
    <div class="lenta">
        <button class="tour_load">Далее</button>
        </div> 
    
     
</main>
    <a id="exit" class="fs24" href="<?php Navigate::middleware("users/logout") ?>">Выход</a>