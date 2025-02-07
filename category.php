<?php
$category = $_GET['category'];
$categoryDir = __DIR__ . "/data/$category";
$categoryInfo = getCategoryInfo($categoryDir);
$downloadItems = array_filter(glob("$categoryDir/*"), "is_dir");

function getCategoryInfo($categoryDir) {
    $infoFile = "$categoryDir/info.txt";
    if (file_exists($infoFile)) {
        return file_get_contents($infoFile);
    }
    return "没有描述信息";
}

function getDownloadInfo($downloadDir) {
    $infoFile = "$downloadDir/info.txt";
    if (file_exists($infoFile)) {
        return file_get_contents($infoFile);
    }
    return "没有描述信息";
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $category; ?> 分类下载</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function searchItems() {
            const query = document.getElementById('search').value.toLowerCase();
            const items = document.querySelectorAll('.download-item');

            items.forEach(item => {
                const title = item.querySelector('.item-title h3').textContent.toLowerCase();
                if (title.includes(query)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="back-button">
            <a href="index.php">
                <button class="back-btn">返回首页</button>
            </a>
        </div>

        <div class="search-container">
            <input type="text" id="search" onkeyup="searchItems()" placeholder="搜索下载条目...">
        </div>

        <h1 class="category-title"><?php echo $category; ?> 分类下载</h1>
        <div class="category-description">
            <p><?php echo $categoryInfo; ?></p>
        </div>

        <div class="download-items">
            <?php foreach ($downloadItems as $item): ?>
                <?php
                    $itemName = basename($item);
                    $itemFile = "data/$category/$itemName/" . $itemName . '.' . $category;
                    $itemInfo = getDownloadInfo($item);
                ?>
                <div class="download-item">
                    <div class="item-title">
                        <h3><?php echo $itemName; ?></h3>
                    </div>
                    <div class="item-info">
                        <p><?php echo $itemInfo; ?></p>
                    </div>
                    <div class="item-download">
                        <a href="<?php echo $itemFile; ?>" download>
                            <button class="download-btn">点击下载</button>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>