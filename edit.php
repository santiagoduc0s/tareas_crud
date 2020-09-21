<?php
include("db.php");

$title = '';
$description = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM task WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $title = $row['title'];
        $description = $row['description'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $query = "
        UPDATE task SET 
        title = '$title', 
        description = '$description' 
        WHERE id=$id
    ";

    mysqli_query($conn, $query);
    $_SESSION['message'] = 'Se modificó la tarea';
    $_SESSION['message_type'] = 'warning';
    header('Location: index.php');
}
?>

<html>
<head>
    <?php include('includes/header.php'); ?>
</head>
<body>
    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-body">
                    <form action="edit.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <div class="form-group">
                            <input name="title" type="text" class="form-control" value="<?php echo $title; ?>" placeholder="Update Title">
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control" cols="30" rows="10"><?php echo $description; ?></textarea>
                        </div>
                        <button class="btn-success" name="update">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/script.php'); ?>
</body>
</html>