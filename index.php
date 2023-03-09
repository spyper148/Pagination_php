<?php
$db = new PDO('mysql:host=localhost;dbname=shop','root');
$page = $_GET['page'] ?? 1;
$pagLimit = 5;
$countItems = $db->query("SELECT COUNT(*) AS count FROM reviews")->fetch(PDO::FETCH_ASSOC);
$lastPage = round($countItems['count']/$pagLimit);
$firstItem = $pagLimit*($page-1);
$reviews = $db->query("SELECT * FROM reviews ORDER BY created_at DESC LIMIT {$firstItem},{$pagLimit}")->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>
<div>
<div id="wrapper">
    <h1>Гостевая книга</h1>
    <div>
        <nav>
            <ul class="pagination">
                <li class="disabled">
                    <a href="?page=1"  aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?for($i=1;$i<=$lastPage;$i++): ?>
                <li><a href="?page=<?=$i?>"><?=$i?></a></li>
                <?endfor;?>
                <li>
                    <a href="?page=<?=$lastPage?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

    <?php foreach($reviews as $review):?>
        <div class="note">
            <p>
                <span class="date"><?=$review['created_at']?></span>
                <span class="name"><?=$review['name']?></span>
            </p>
            <p><?=$review['review']?></p>
        </div>
    <?php endforeach; ?>
</div>
</div>
</body>
</html>
