<?php
session_start();

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'administrar_tareas'
) or die(mysqli_error($mysqli));
