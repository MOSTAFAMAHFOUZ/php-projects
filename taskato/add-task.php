
<?php require_once 'inc/header.php';?>
<?php
$errors = [];
$stats = ["low", "normal", "high"];
$success = "";
if (isset($_POST['title'])) {
    $title = htmlspecialchars($_POST['title']);
    $priority = $_POST['priority'];

    // validation
    if (strlen($title) < 3) {
        $errors[] = "Title must be greater than 3 chars";
    }

    if (!in_array($priority, $stats)) {
        $errors[] = "please choose valid priority";
    }

    if (empty($errors)) {
        $tasks = json_decode(file_get_contents("data/tasks.json"), true);
        $id = rand(1000, 10000);
        $tasks[$id] = [
            "id" => $id,
            "title" => $title,
            "priority" => $priority,
        ];
        $tasks = file_put_contents("data/tasks.json", json_encode($tasks));
        $success = "Task Addedd Successfully";

    }

}
?>


<h1 class="text-center my-3">Add New Task</h1>
<div class="col-8 mx-auto">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form border p-3">
        <div class="mb-3">
            <?php if (count($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger p-1"><?php echo $error; ?></div>
                <?php endforeach;?>
            <?php endif;?>
            <?php if ($success): ?>
                <div class="alert alert-success p-1"><?php echo $success; ?></div>
            <?php endif;?>
        </div>
        <div class="mb-3">
            <label for="title">Task Title</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="mb-3">
            <label for="priority">Task Priority</label>
            <select name="priority" id="priority" class="form-control">
                <option value="">-------</option>
                <option value="low">Low</option>
                <option value="normal">Normal</option>
                <option value="high">High</option>
            </select>
        </div>
        <div class="mb-3">
            <input type="submit"  class="form-control bg-success" value="Save">
        </div>
    </form>
</div>
<?php require_once 'inc/footer.php';?>