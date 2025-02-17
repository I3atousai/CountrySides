<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
use App\Service\Guard;
use App\Model\Tour;
use App\Model\TourPhotos;
use App\Model\Favorites;

Guard::only_user_api();

// порция постов
$portion = isset($_GET['portion']) ? $_GET['portion'] : 1;

// лимит порции постов
$limit = 3;
// вычисляем отступ
$offset = $limit * ($portion - 1);

$tours = Tour::query(
    get: ['*'],
    fetch_mode: "all",
    limit: $limit,
    offset: $offset,
    sorted:[
        "col"=>"id",
        "type"=>"DESC",
    ]
);
foreach ($tours as $i => $tour) {
    $images = TourPhotos::query(
        get: ['image'],
        fetch_mode: "all",
        params: [
            ['id_tour', '=', $tour['id'], 'value']
            ]
        );
    $fav = Favorites::query(
        get: ['*'],
        params: [
            ['id_tour', '=', $tour['id'], 'value', "AND"],
            ['id_user', '=', $_SESSION['auth']['id'], 'value']
            ]
    );
    if ($fav) {
        $tours[$i]['fav'] = '1';
    }
    $tours[$i]['images'] = $images;
}

// общее количество постов
$count_tours = Tour::count();
$is_next = $limit * $portion < $count_tours; //  true/false
// отправляем посты
http_response_code(200);
echo json_encode([
    'tours' => $tours,
    'is_next' => $is_next,
]);

