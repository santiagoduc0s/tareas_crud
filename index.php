<!DOCTYPE html>
<html lang="es">
<head>
    <?php include './includes/header.php'; ?>
</head>
<body>
    <?php include('includes/nav.php'); ?>

    <main class="container p-4">
        <div class="row">
            <div class="col-md-4">

                <!-- mensaje -->
                <?php 
                include("db.php");
                if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message']; // <?= = echo ?> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php unset($_SESSION['message']);} ?>

                <!-- agregar tarea -->
                <div class="card card-body">
                    <form action="save_task.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Titulo" autofocus>
                        </div>
                        <div class="form-group">
                            <textarea name="description" rows="2" class="form-control" placeholder="Descripción"></textarea>
                        </div>
                        <input type="submit" name="save_task" class="btn btn-success btn-block" value="Guardar tarea">
                    </form>
                </div>

            </div>
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Creación</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $query = "SELECT * FROM task";
                        $result_tasks = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result_tasks)) : ?>
                            <tr>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="delete_task.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include('includes/script.php'); ?>
</body>
</html>
