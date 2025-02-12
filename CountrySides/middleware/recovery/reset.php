<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Helpers\Component;
use App\Controller\RecoveryController;
use App\Model\User;
use App\Helpers\Navigate;
$data = RecoveryController::index();


Component::render("public/head");
?>
<main>
<div class="container">
           <h1 class="fs40 mb32 text_blur">Новый пароль</h1> <!-- first cut in action below -->
          <form  class="form-1" method="POST"    action="../recovery/reset.php"><input required
                class="mb8"
                pattern="[a-z0-9]{8,}"
                type="password"
                name="password"
                placeholder="Пароль более 8 символов"
              />
            <button class="btn-1 fs24" name="submit">Подтвердить</button>
          </form>
          <?php
  if (isset($_GET['password_recovery_hash'])) {
    # code...
    $_SESSION['password_recovery_hash'] = $_GET['password_recovery_hash'];
    $_SESSION['email'] = $_GET['email'];
  }


  if (isset($_POST["submit"])) {
date_default_timezone_set('Russia/Moscow');
            $date_now = date('Y-m-d h:i:s ', time());

      $get = [
        "users.pass_reset_hash"
    ];
    $tables = ["users"];
    $params = [
        ["users.email", "=", $_SESSION['email'], "value"]
    ];
    $reset_time = User::query(get:$get, tables:$tables, params:$params, fetch_mode:'one') ;
        ?>
          <?php
        if ($_SESSION['password_recovery_hash'] != $reset_time['pass_reset_hash']) {
          ?>
            <p class="failed_message bold"><?php echo "Ссылка повреждена"; ?> </p>
          <?php
        } else {
          
          $password_new = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
          User::update(
            ['password_hash' => $password_new,
            'pass_reset_hash' => "NULL"
          ],
            [
                ['email', '=', $_SESSION['email'], 'value']
            ]
        );
        ?>
              <p class="failed_message bold"><?php echo "Восстановление пароля прошло успешно"; ?> </p>
            <?php
        sleep(4);
        header( Navigate::view('public/login', mode:'return'));
        }
    }
    ?>
    </div>
</main> <?php
    Component::render("public/foot");
    ?>