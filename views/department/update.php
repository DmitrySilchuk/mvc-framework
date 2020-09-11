<?php

/**
 * @var $department DepartmentModel
 */
?>

<h1>Updating department: <?= $department->name ?></h1>

<form action="/department/update/<?= $department->id ?>" method="POST">
    <div class="form-group">
        <label for="name">Name: </label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?= $department->name ?>">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
