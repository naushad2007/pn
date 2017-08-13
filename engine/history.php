<?php
// Вывод видео
$sql = "SELECT `history` FROM `users` WHERE id = '$id'";
$query = mysqli_query($connect_DB, $sql);
$history_array = mysqli_fetch_array($query);
$videos_history = explode(', ', $history_array[0]);
$count_a = count($videos_history);
$videos_history = array_reverse($videos_history);
echo '<div class="content">';
for ($i = 1; $i < $count_a; $i++) {
    $id_post = (int)$videos_history[$i];
    $sql = "SELECT * FROM `posts` WHERE `id` = '$id_post'";
    $query = mysqli_query($connect_DB, $sql);
    $info_array = mysqli_fetch_assoc($query);
    echo '
    <div class="row z-depth-3">
        <a href="/?id='. $id_post .'">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img src="'.$info_array['pre'].'" alt="">
                </div>
            </div>
        </a>
        <div class="card-content center">
        <span class="card-title">'.$info_array['title'].'</span>
    </div>
                <div class="sinfo">
                    <div class="sviews inline-block"><i class="tiny material-icons">visibility</i><div class="itext inline-block">'.$info_array['views'].'</div></div>
                    <div class="stime inline-block"><i class="tiny material-icons">access_time</i><div class="itext inline-block">'.$info_array['time'].'</div></div>
                    <div class="inline-block right">';
    if ($_COOKIE['logining'] == 2) {
        if (in_array($id_post, $like_array)){
            echo '<a href="/engine/like.php?id='. $id_post  .'&iduser='. $id .'&like=1"><i class="tiny material-icons">favorite</i></a>';
        }
        else{
            echo '<a href="/engine/like.php?id='. $id_post  .'&iduser='. $id .'&like=2"><i class="tiny material-icons">favorite_border</i></a>';
        }
    }
    else {
        echo '<a href="/"><img src="../templete/images/un_like.png" alt="" class="infopngr"></a>';
    }

    echo '<div class="itext inline-block">'.$info_array['likes'].'</div></div>
                </div>
            </div>
    ';
}
echo '
<ul class="pagination">
    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
for ($i = 1; $i <= $pages; $i++){
    echo '
        <li class="waves-effect"><a href="?page='.$i.'">'.$i.'</a></li>
        ';
}
echo '<li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li></ul>';
?>