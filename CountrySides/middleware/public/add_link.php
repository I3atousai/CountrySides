<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
session_start();
use App\Model\Link;
use App\Helpers\Navigate;

if (isset($_SESSION['auth'])) {
    $_POST['id_user'] = $_SESSION['auth']['id'];
}

$short = password_hash($_POST["long_link"], PASSWORD_DEFAULT);
$short = str_replace( array( '\'', '"',',' , ';', '<', '>','$', '.', '/', '\\', '|' ), '', $short);
$short = substr($short, -7);
$POST['long_link'] = str_replace( array( '\'', '"',',' , ';', '<', '>'), '', $POST['long_link']);

$_POST['short_link'] = $short ;


                    // $message =  "<?php \n" . "\$" . 'long ="' . $_POST["long_link"] . '";';
                    // $message .= file_get_contents("../links/template.php",TRUE);
                    // $myfile = fopen("../../links/" . $short . '.php' , "w") or die("Unable to open file!");
                    // fwrite($myfile, $message);
                    // fclose($myfile);

$add = Link::add($_POST);


if ($add) {
    $_SESSION['last_short'] = $_POST['short_link'];
    Navigate::link("index.php", [], "redirect");
} else {
    echo "Не удалось добавить пользователя, или такой пользователь уже существует";
}
