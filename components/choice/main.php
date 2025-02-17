<?php

use App\Helpers\Navigate;

?>

<main>

    <div class="container">
        
       <img class="logo_choice center mb60" src="<?php Navigate::image("logo/png/logo-no-background.png") ?>" alt="" />
        <nav class="mb60">
            <a class="fs24" href="<?php Navigate::view("public/login") ?>">Войти</a>
            <a class="fs24" href="<?php Navigate::view("public/registration") ?>">Регистрация</a>
            <a class="fs24" href="<?php Navigate::view("public/admin-login") ?>">Я админ</a>
        </nav>
    </div>
</main>