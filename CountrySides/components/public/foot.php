<?php 

use App\Helpers\Navigate;

?>
<footer>
    <div class="sub_footer">
        <h2 class="fs32">ChainLink</h2>
        <nav>
            <?php if (isset($_SESSION['auth'])) { ?>
                <a class="fs20" href="<?php Navigate::view('users/profile') ?>">Мой Профиль</a>
           <?php } ?>
            <a class="fs20" href="<?php Navigate::view('public/instruction') ?>">Инструкция</a>
        </nav>

    </div>
    <div class="sub_footer">
        <div class="icons fs24">
            <a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.twitter.com"><i class="fab fa-twitter"></i></a>
            <a href="https://www.youtube.com"><i class="fab fa-youtube"></i></a>
    
        </div>
        <p>© 2025-2025 ChainLink</p>
    </div>
</footer>
<?php
foreach ($data['foot']['css'] as $file) { ?>
    <link rel="stylesheet" href="<?php Navigate::css($file) ?>">
<?php } ?>

<?php
foreach ($data['foot']['service'] as $file) { ?>
    <script src="<?php Navigate::service($file) ?>"></script>
<?php } ?>

<?php
foreach ($data['foot']['js'] as $file) { ?>
    <script src="<?php Navigate::js($file) ?>"></script>
<?php } ?>

</body>

</html>