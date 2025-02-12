<?php

use App\Helpers\Navigate;

?>

<main>

    <div class="container">
        <h1 class="mb60 fs40">ChainLink</h1>
        <nav class="mb60">
            <a class="fs24" href="<?php Navigate::view("public/login") ?>">Войти</a>
            <a class="fs24" href="<?php Navigate::view("public/registration") ?>">Регистрация</a>
        </nav>
    </div>
</main>