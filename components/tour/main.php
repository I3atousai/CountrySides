<?php 

use App\Helpers\Navigate;
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

$tour = $data['tour'];

// print_r($tour);
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
            <div class="tour mb24">
                <div id="<?php echo $ind ?>" class="tour_photos">
                   
                   <?php  foreach ($tour['images'] as $img) { ?>
                        <div class="tour_photo">
                            <img src="<?php Navigate::image('tours/' . $img['image']) ?>" alt="">
                        </div>
                  <?php  } ?>
                   
                </div>
                <div class="tour_content">
                    <h3><?php echo $tour['title'] ?></h3>
                    <p>
                        <?php echo $tour['content'] ?>
                    </p>
                </div>
            </div>

</main>