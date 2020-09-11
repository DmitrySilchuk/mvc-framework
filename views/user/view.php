<?php
/**
 * @var $user UserModel
 * @var $departments array
 */
?>
<h1>User: <?= $user->name ?></h1>

<a href="/user/update/<?= $user->id ?>" class="btn btn-info">Update</a>
<a href="/user/delete/<?= $user->id ?>" class="btn btn-danger">Delete</a>

<div class="list-group">
    <div class="list-group-item">ID: <?= $user->id ?></div>
    <div class="list-group-item">Department: <?= !empty($departments[$user->department_id]) ? $departments[$user->department_id] : '' ?></div>
    <div class="list-group-item">Email: <?= $user->email ?></div>
    <div class="list-group-item">Name: <?= $user->name ?></div>
    <div class="list-group-item">Address: <?= $user->address ?></div>
    <div class="list-group-item">Phone: <?= $user->phone ?></div>
    <div class="list-group-item">Comment: <?= $user->comment ?></div>
</div>
