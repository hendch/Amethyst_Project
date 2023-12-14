<?php
session_start();
include '../../Controller/threadController.php';
include_once '../../Model/threadModel.php';
$threadController = new ThreadController();
$threads = $threadController->getAllThreads();
$recentThreads = $threadController->getRecentThreads();
$error = "";
$thread = null;
// Check if the user is logged in (adjust as needed)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or take appropriate action
    header('Location: login.php');
    exit();
}
// Check if a thread_id is provided in the URL
if (isset($_GET['thread_id'])) {
    $thread_id = $_GET['thread_id'];
    // Increment views when the user views the thread
    $threadController->incrementThreadViews($thread_id);
    // Fetch the thread details
    $thread = $threadController->getThreadById($thread_id);
    header("Location: viewThread.php?thread_id=$thread_id");
}
// Check if the form for creating a new thread is submitted
if (isset($_POST["title"]) && isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    if (!empty($_POST['title']) && !empty($_SESSION['user_id']) && !empty($_SESSION['username'])) {
        // Generate the created_at timestamp (assuming you want the current time)
        $created_at = date('Y-m-d H:i:s');
        $usernameFromSession = $_SESSION['username'];
        // Create the Thread object with the username
        $thread = new Thread($_POST['title'], $_SESSION['user_id'], $created_at, $usernameFromSession);
        $threadController = new ThreadController();
        $threadController->addThread($thread);
        header('Location: createThread.php'); // Redirect to the list of threads page
    } else {
        $error = "Missing information";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>view threads</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/threads.css">
</head>

<body>
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mb-3" style="margin-top: 95px;">
                <!-- <div class="row text-left mb-5">
<div class="col-lg-6 mb-3 mb-sm-0">
<div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50"
style="width: 100%;">
<select class="form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50"
data-toggle="select" tabindex="-98">
<option> Categories </option>
<option> Learn </option>
<option> Share </option>
<option> Build </option>
</select>
</div>
</div>
<div class="col-lg-6 text-lg-right">
<div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50"
style="width: 100%;">
<select class="form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50"
data-toggle="select" tabindex="-98">
<option> Filter by </option>
<option> Votes </option>
<option value="posts" <?php echo ($filter === 'posts') ? 'selected' : ''; ?>>Posts
</option>
<option> Views </option>
</select>
</div>
</div>
</div> -->
<?php foreach ($threads as $thread): ?>
                    <div
                        class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded-0">
                        <div class="row align-items-center">
                            <div class="col-md-8 mb-3 mb-sm-0">
                                <h5>
                                    <a href="createThread.php?thread_id=<?php echo $thread['thread_id']; ?>"
                                        class="text-primary">
                                        <?php echo $thread['title']; ?>
                                    </a>
                                </h5>
                                <p class="text-sm">
                                    <span class="op-6">Posted</span>
                                    <a class="text-secondary" href="#">
                                        <?php echo $threadController->timeAgo($thread['created_at']); ?>
                                    </a>
                                    <span class="op-6">ago by</span>
                                    <a class="text-secondary" href="#">
                                        <?php echo $thread['username']; ?>
                                    </a>
                                </p>
                                <div class="text-sm op-6">
                                    <a class="op-6" href="#"><i class="text-secondary">#Development</i></a>
                                    <a class="text-black mr-2" href="#"><i class="text-secondary">#AppStrap Theme</i></a>
                                </div>
                            </div>
                            <div class="col-md-4 op-7">
                                <div class="row text-center op-7">
                                    <div class="col px-1">
                                        <i class="ion-ios-chatboxes-outline icon-1x"></i>
                                        <span class="d-block text-secondary">
                                            <?php echo $threadController->getPostCountByThread($thread['thread_id']); ?>
                                            posts
                                        </span>
                                    </div>
                                    <div class="col px-1">
                                        <i class="ion-ios-eye-outline icon-1x"></i>
                                        <span class="d-block text-secondary">
                                            <?php echo $thread['views']; ?> Views
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
<div class="col-lg-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
                <div
                    style="visibility: hidden; display: none; width: 285px; height: 801px; margin: 0px; float: none; position: static; inset: 85px auto auto;">
                </div>
                <div data-settings="{&quot;parent&quot;:&quot;#content&quot;,&quot;mind&quot;:&quot;#header&quot;,&quot;top&quot;:10,&quot;breakpoint&quot;:992}"
                    data-toggle="sticky" class="sticky" style="top: 85px;">
                    <div class="sticky-inner">
                        <a class="btn btn-lg btn-block btn-success rounded-0 py-4 mb-3 bg-op-6 roboto-bold" href="#"
                            data-bs-toggle="modal" data-bs-target="#addThreadModal">Add a thread</a>

                        <div class="bg-black-opacity mb-3">
                            <h4 class="px-3 py-4 op-5 m-0 text-white">Active Topics</h4>
                            <hr class="m-0">

                            <?php foreach ($recentThreads as $thread): ?>
                                <div class="pos-relative px-3 py-3">
                                    <h6 class="text-primary text-sm">
                                        <a href="viewThread.php?thread_id=<?php echo $thread['thread_id']; ?>"
                                            class="text-primary">
                                            <?php echo $thread['title']; ?>
                                        </a>
                                    </h6>
                                    <p class="text-sm">
                                        <span class="op-6 text-white">Posted</span>
                                        <a class="text-plum" href="#">
                                            <?php echo $threadController->timeAgo($thread['created_at']); ?>
                                        </a>
                                        <span class="op-6 text-white">ago by</span>
                                        <a class="text-plum" href="#">
                                            <?php echo $thread['username']; ?>
                                        </a>
                                    </p>
                                </div>
                                <hr class="m-0">
                            <?php endforeach; ?>

                        </div>
                        <hr class="m-0">
                    </div>

                    <div class="card bg-black-opacity text-sm">
                        <h4 class="px-3 py-4 op-5 m-0 roboto-bold text-primary">Stats</h4>
                        <hr class="my-0">
                        <div class="row text-center d-flex flex-row op-7 mx-0">
                            <div class="col-sm-6 flex-ew text-center py-3 border-bottom border-right">
                                <a class="d-block lead font-weight-bold text-primary" href="#">
                                    <?php echo $threadController->getTotalTopicsCount(); ?>
                                </a> Topics
                            </div>
                            <div class="col-sm-6 col flex-ew text-center py-3 border-bottom mx-0">
                                <a class="d-block lead font-weight-bold text-primary" href="#">
                                    <?php echo $threadController->getTotalPostsCount(); ?>
                                </a> Posts
                            </div>
                        </div>
                        <div class="row d-flex flex-row op-7">
                            <div class="col-sm-6 flex-ew text-center py-3 border-right mx-0">
                                <a class="d-block lead font-weight-bold text-primary" href="#">
                                    <?php echo $threadController->getTotalMembersCount(); ?>
                                </a> Members
                            </div>
                            <div class="col-sm-6 flex-ew text-center py-3 mx-0">
                                <a class="d-block lead font-weight-bold text-primary" href="#">
                                    <?php echo $threadController->getNewestMember(); ?>
                                </a> last uploader
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    </div>
    <div class="modal fade" id="addThreadModal" tabindex="-1" aria-labelledby="addThreadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addThreadModalLabel">Add a Thread</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="threadTitle" class="form-label">Thread Title</label>
                            <input type="text" class="form-control" id="threadTitle" name="title" required>
                        </div>
                        <!-- Add more form fields as needed -->
                        <button type="submit" class="btn btn-primary">Create Thread</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
    </script>
</body>

</html>