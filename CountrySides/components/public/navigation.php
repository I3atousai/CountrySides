<?php

use App\Helpers\Navigate;

?>

<aside>
    <img class="aside_logo mb24" src="<?php Navigate::image("public/logo.png") ?>" alt="" />
    <nav>
        <a class="fs24 mb16" href="<?php Navigate::view("users/profile") ?>">Профиль <span>👨‍💻</span></a>
        <a class="fs24 mb16" href="<?php Navigate::view("users/lenta") ?>">Лента <span>📜</span></a>
        <a class="fs24 mb16" href="<?php Navigate::view("users/chats") ?>">Мои Чаты <span>💬</span> </a>
        <a class="fs24 mb16" href="<?php Navigate::view("users/friends") ?>">Мои Друзья <span>👪</span></a>
    </nav>
</aside>