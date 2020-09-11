<?php
/**
 * @var $departments array
 * @var $user UserModel
 */
?>
<h1>Updating user: <?= $user->name ?></h1>

<form action="/user/update/<?= $user->id ?>" method="POST">
    <div class="form-group">
        <label for="department">Department: </label>
        <select class="form-control" name="department" id="department">
            <?php
            foreach ($departments as $key => $name) { ?>
                <option value="<?= $key ?>" <?= $user->department_id == $key ? 'selected' : '' ?>><?= $name ?></option>
                <?php
            } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="email">Email: </label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?= $user->email ?>">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div class="form-group">
        <label for="name">Name: </label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?= $user->name ?>">
    </div>

    <div class="form-group">
        <label for="address">Address: </label>
        <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="<?= $user->address ?>">
    </div>

    <div class="form-group">
        <label for="phone">Phone: </label>
        <input name="phone" class="form-control" type="tel" id="phone" placeholder="072-123-45-57" value="<?= $user->phone ?>">
    </div>

    <div class="form-group">
        <label for="comment">Comment: </label>
        <textarea name="comment" class="form-control" id="comment" placeholder="Comment"><?= $user->comment ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
