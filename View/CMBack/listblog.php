<?php
include "../controller/blog.php";

$c = new blogs();
$tab = $c->listblog();

?>

<center>
    <h1>List of blogs</h1>
    <h2>
        <a href="addblog.php">Add a blog</a>
    </h2>
</center>

<table border="1" align="center" width="70%">
    <tr>
        <th>blogid</th>
        <th>postcat</th>
        <th>blogtitle</th>
        <th>descriptionb</th>
    </tr>
    <?php


$searchKeyword = '';
$categoryFilter = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchKeyword = isset($_POST['search']) ? $_POST['search'] : '';
    $categoryFilter = isset($_POST['category']) ? $_POST['category'] : '';

    if (!empty($searchKeyword) || !empty($categoryFilter)) {
        $filteredBlogList = [];

        foreach ($blogList as $blog) {
            $titleMatch = stripos($blog['title'], $searchKeyword) !== false;
            $categoryMatch = $categoryFilter == '' || $blog['category'] == $categoryFilter;

            if ($titleMatch && $categoryMatch) {
                $filteredBlogList[] = $blog;
            }
        }

        $listblog = $filteredbloglist;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog List</title>
</head>
<body>
    <form method="post">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($searchKeyword); ?>">

        <label for="category">Category:</label>
        <select id="category" name="category">
            <option value="">All</option>
            <option value="Technology" <?php echo $categoryFilter == 'Technology' ? 'selected' : ''; ?>>Technology</option>
            <option value="AI" <?php echo $categoryFilter == 'AI' ? 'selected' : ''; ?>>AI</option>
            <option value="Culture" <?php echo $categoryFilter == 'Culture' ? 'selected' : ''; ?>>Culture</option>
        </select>

        <input type="submit" value="Filter">
    </form>

</body>
</html>

    <?php
    foreach ($tab as $blogs) {
    ?>
       echo '  <tr>
            <td>'.$blogs['blogid'].'</td>
            <td>'.$blogs['postcat'].'</td>
            <td>'.$blogs['blogtitle'].'</td>
            <td>'.= $blogs['descriptionb'].'</td>
            <<td>
                <a href="updateblog.php?updateid=<?= $c['blogid']; ?>" class="update-btn">Update</a>
            </td>
            <td>
                <a href="deleteblog.php?deleteid=<?= $c['blogid']; ?>" class="delete-btn">Delete</a>
            </td>
        </tr>' 
    <?php
    }
    ?>
</table>
