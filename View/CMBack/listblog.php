<?php
include_once '../controller/blog.php'; 
include_once '../model/blogM.php'; 
include_once '../config.php'; 
$c = new blogs();
$tab = $c->listblog();

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$starting_limit = ($page - 1) * $limit;

// Fetch all rows from the PDOStatement
$allRows = $tab->fetchAll(PDO::FETCH_ASSOC);

$total_results = count($allRows);
$total_pages = ceil($total_results / $limit);

$filteredBlogList = array_slice($allRows, $starting_limit, $limit);

$searchKeyword = '';
$categoryFilter = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchKeyword = isset($_POST['search']) ? $_POST['search'] : '';
    $categoryFilter = isset($_POST['category']) ? $_POST['category'] : '';

    if (!empty($searchKeyword) || !empty($categoryFilter)) {
        $filteredBlogList = [];

        foreach ($allRows as $blog) {
            $titleMatch = stripos($blog['blogtitle'], $searchKeyword) !== false;
            $categoryMatch = $categoryFilter == '' || $blog['postcat'] == $categoryFilter;

            if ($titleMatch && $categoryMatch) {
                $filteredBlogList[] = $blog;
            }
        }

        $total_results = count($filteredBlogList);
        $total_pages = ceil($total_results / $limit);
        $filteredBlogList = array_slice($filteredBlogList, $starting_limit, $limit);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog List</title>
    <!-- Include your CSS stylesheets here -->
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Left Panel -->
            <aside id="left-panel" class="left-panel">
                <!-- Include your left panel content here -->
            </aside>

            <!-- Right Panel -->
            <div id="right-panel" class="right-panel">
                <!-- Header -->
                <header id="header" class="header">
                    <!-- Include your header content here -->
                </header>

                <!-- Breadcrumbs -->
                <div class="breadcrumbs">
                    <!-- Include your breadcrumbs content here -->
                </div>

                <!-- Content -->
                <div class="content mt-3">
                    <div class="animated fadeIn">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Data Table</strong>
                                    </div>
                                    <div class="card-body">
                                        <center>
                                            <h1>List of blogs</h1>
                                            <h2><a href="addblog.php">Add a blog</a></h2>
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
                                        </center>

                                        <table border="1" align="center" width="70%">
                                            <tr>
                                                <th>blogid</th>
                                                <th>postcat</th>
                                                <th>blogtitle</th>
                                                <th>descriptionb</th>
                                                <th>Action</th>
                                            </tr>

                                            <?php
                                            foreach ($filteredBlogList as $blog) {
                                            ?>
                                                <tr>
                                                    <td><?= $blog['blogid']; ?></td>
                                                    <td><?= $blog['postcat']; ?></td>
                                                    <td><?= $blog['blogtitle']; ?></td>
                                                    <td><?= $blog['descriptionb']; ?></td>
                                                    <td>
                                                        <a href="updateblog.php?updateid=<?= $blog['blogid']; ?>" class="update-btn">Update</a>
                                                        <a href="deleteblog.php?deleteid=<?= $blog['blogid']; ?>" class="delete-btn">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </table>

                                        <!-- Pagination Links -->
                                        <?php
                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            echo '<a href="?page=' . $i . '" class="links">' . $i . '</a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .animated -->
                </div><!-- .content -->
            </div><!-- /#right-panel -->
        </div><!-- .row -->
    </div><!-- .container-fluid -->

    <!-- Include your JavaScript files at the end of the body -->
    <script src="path/to/your/jquery.min.js"></script>
    <script src="path/to/your/popper.min.js"></script>
    <script src="path/to/your/bootstrap.min.js"></script>
    <!-- Include other JS files as needed -->
</body>

</html>
