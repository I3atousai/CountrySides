<?php

use App\Helpers\Navigate;

?>
<main>
    <div class="container">
        <h1 class="fs40 mb32">Регистрация</h1>
        <form class="form-1 mb60" method="post" action="<?php Navigate::middleware("public/registration") ?>">
            <input required class="mb8" minlength="3" maxlength="70" type="text" name="name" placeholder="Придумайте Nickname" />
            <input required class="mb8" type="email" name="email" placeholder="Почта" /> 
            <input required
                class="mb8"
                pattern="[a-z0-9]{8,}"
                type="password"
                name="password"
                placeholder="Пароль более 8 символов"
              />
            <button class="btn-1 fs24">Создать</button>
        </form>
    </div>
</main>