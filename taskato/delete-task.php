
<?php
require_once 'inc/header.php';
$tasks = json_decode(file_get_contents("data/tasks.json"), true);
$success = "";
$error = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($tasks[$id])) {
        unset($tasks[$id]);
        $tasks = file_put_contents("data/tasks.json", json_encode($tasks));
        $success = "Task Deleted Successfully";
    } else {
        $error = "Task Not Found";
    }
} else {
    $error = "Task Not Found";
}

?>
<h1 class="text-center my-3">Task</h1>
<div class="col-12 mx-auto my-5">
    <?php if ($success): ?>
        <div class="alert alert-success p-1 display-3"><?php echo $success; ?></div>
    <?php endif;?>
    <?php if ($error): ?>
        <div class="alert alert-danger display-1 text-center">
            <div class=" ">404</div>
            <div class=" p-1 "><?php echo $error; ?></div>
        </div>
    <?php endif;?>
</div>
<?php require_once 'inc/footer.php';?>