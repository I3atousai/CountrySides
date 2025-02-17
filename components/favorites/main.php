<?php 

use App\Helpers\Navigate;
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
session_start();

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
<div class="lenta">
       
    </div> 
        <button class="tour_load">Далее</button>
</main>