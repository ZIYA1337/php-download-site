<?php
$categories = array_filter(glob("data/*"), "is_dir");

function getCategoryInfo($categoryDir) {
    $infoFile = "$categoryDir/info.txt";
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
    <title>CsLua下载站首页</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 class="home-title">欢迎来到Cslua下载站</h1>
        <div class="category-list">
            <?php foreach ($categories as $categoryDir): ?>
                <?php
                    $categoryName = basename($categoryDir);
                    $categoryInfo = getCategoryInfo($categoryDir);
                ?>
                <div class="category-item">
                    <h3><?php echo $categoryName; ?></h3>
                    <p><?php echo $categoryInfo; ?></p>
                    <a href="category.php?category=<?php echo $categoryName; ?>">
                        <button class="view-category-btn">查看<?php echo $categoryName; ?>下载</button>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>