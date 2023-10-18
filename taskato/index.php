<?php
require_once 'inc/header.php';
require_once 'inc/functions.php';
$tasks = json_decode(file_get_contents("data/tasks.json"), true);
$stats = ["low", "normal", "high"];

if (isset($_GET['priority'])) {
    $filtered_tasks = [];
    $priority = $_GET['priority'];
    if (in_array($priority, $stats)) {
        foreach ($tasks as $task) {
            if ($task['priority'] == $_GET['priority']) {
                $filtered_tasks[] = $task;
            }
        }
        $tasks = $filtered_tasks;
    }

}

?>
<h1 class="text-center my-3">All Tasks</h1>
<div class="col-12">
    <div class="filters my-3">
        <a href="index.php?priority=low" class="btn btn-info mr-3">Low</a>
        <a href="index.php?priority=normal" class="btn btn-warning mr-3">Normal</a>
        <a href="index.php?priority=high" class="btn btn-danger mr-3">High</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Priority</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;foreach ($tasks as $task): ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $task['title']; ?></td>
                <td>
                    <?php echo showPriority($task['priority']); ?>
                </td>
                <td>
                    <a href="edit-task.php?id=<?=$task['id'];?>" class="btn btn-info mr-3">Edit</a>
                    <a href="delete-task.php?id=<?=$task['id'];?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php require_once 'inc/footer.php';?>