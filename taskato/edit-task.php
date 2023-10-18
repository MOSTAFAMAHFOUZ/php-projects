
<?php require_once 'inc/header.php';
$tasks = json_decode(file_get_contents("data/tasks.json"), true);
$success = "";
$errors = [];
$stats = ["low", "normal", "high"];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($tasks[$id])) {
        $task = $tasks[$id];
    } else {
        header("location:index.php");
        die;
    }
} else {
    header("location:index.php");
    die;
}

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

        $task = [
            'id' => $task['id'],
            "title" => $title,
            "priority" => $priority,
        ];

        $tasks[$id] = $task;
        $tasks = file_put_contents("data/tasks.json", json_encode($tasks));
        $success = "Task Updated Successfully";

    }
}

?>
<h1 class="text-center my-3">Edit Task</h1>
<div class="col-6 mx-auto">

    <form action="edit-task.php?id=<?php echo $task['id']; ?>" method="post" class="form border p-3">
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
            <input type="text" value="<?php echo $task['title']; ?>" name="title" id="title" class="form-control">
        </div>
        <div class="mb-3">
            <label for="priority">Task Priority</label>
            <select name="priority" id="priority" class="form-control">
                <option value="">-------</option>
                <option <?php if ($task['priority'] == "low") {echo 'selected';}?> value="low">Low</option>
                <option <?php if ($task['priority'] == "normal") {echo 'selected';}?> value="normal">Normal</option>
                <option <?php if ($task['priority'] == "high") {echo 'selected';}?> value="high">High</option>
            </select>
        </div>
        <div class="mb-3">
            <input type="submit"  class="form-control bg-success" value="Save">
        </div>
    </form>
</div>
<?php require_once 'inc/footer.php';?>