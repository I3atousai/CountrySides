<?php


require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
use App\Model\Link;


// all boxes older than a day
$links = Link::query(
   get: ['*, DATEDIFF(links.date_create, CURRENT_TIMESTAMP) as diff'],
   params: [
    ['DATEDIFF(links.date_create, CURRENT_TIMESTAMP)', '<','-14', 'value' ]
   ]
   );

foreach ($links as $link) {
    echo $link['short_link'];
    if (!isset($link['id_user'])) {
        // unlink("../../links/" . $link['short_link']);
        Link::delete([ ['id', '=', $link['id'], 'value'], ]);
    }
    if ($link['diff'] < -180) {
        // unlink("../../links/" . $link['short_link']);
        Link::delete([ ['id', '=', $link['id'], 'value'], ]);
    }
    // deletes links older than half a year and links with no user id older than 14 days
}

// $sql = "SELECT *, DATEDIFF(logged_box.date_create, CURRENT_TIMESTAMP) as diff FROM logged_box WHERE DATEDIFF(logged_box.date_create, CURRENT_TIMESTAMP) < 0;";

// try {
//     $req = $connect->prepare($sql);
// $req->execute();
// } catch (\Throwable $th) {
//     echo $th->getMessage();
// }

// $all_boxes = $req->fetchAll();


// echo $this_many_boxes = count($all_boxes);
// echo '<br>';


// for ($i=0; $i < $this_many_boxes; $i++) { 
//     $id = $all_boxes[$i]['id'];
//     $join_link = $all_boxes[$i]['join_link'];
//     $sql = "SELECT COUNT(name) FROM logged_box JOIN users_and_logged_boxes WHERE 
// users_and_logged_boxes.box_id = logged_box.id AND users_and_logged_boxes.box_id = $id";

// try {
//     $req = $connect->prepare($sql);
//     $req->execute();
//     $user_count = $req->fetch();

//     // echo "<pre>";
//     // print_r($user_count) ;
//     // echo "<pre/>";
    

//     if ($all_boxes[$i]['diff'] == -25) { 

//         $get = [
//             "ualb.user_id",
//             "ualb.box_id",
//             "ualb.id"
//         ];
//         $tables = ["users_and_logged_boxes as ualb"];
//         $params = [
//             ["ualb.box_id", "=", $all_boxes[$i]["id"], "system"]
//         ];
//            $box_users = UALB::query(get:$get, tables:$tables, params:$params);
//             for ($u=0; $u < count($box_users); $u++) { 
//                 Notifications::add([
//                     'box_id' => $all_boxes[$i]['id'],
//                     "text" => "Коробка ". $all_boxes[$i]['name'] ." Удалится через 4 дня",
//                     "user_id" => $box_users[$u]['user_id']
//                 ]);
//             }

//     }


?>