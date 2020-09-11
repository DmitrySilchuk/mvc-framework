<?php

/**
 * @var $department DepartmentModel
 */
?>

<h1>Department: <?= $department->name ?></h1>

<a href="/department/update/<?= $department->id ?>" class="btn btn-info btn-mb15">Update</a>
<a href="/department/delete/<?= $department->id ?>" class="btn btn-danger btn-mb15">Delete</a>

<div class="list-group">
    <div class="list-group-item">ID: <?= $department->id ?></div>
    <div class="list-group-item">Name: <?= $department->name ?></div>
</div>
