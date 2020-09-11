<?php
/**
 * @var $departments array
 */
?>
<h1>Add new user</h1>

<form action="/user/add" method="POST">
    <div class="form-group">
        <label for="department">Department: </label>
        <select class="form-control" name="department" id="department">
            <?php
            foreach ($departments as $key => $name) { ?>
                <option value="<?= $key ?>"><?= $name ?></option>
                <?php
            } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="email">Email: </label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div class="form-group">
        <label for="name">Name: </label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Name">
    </div>

    <div class="form-group">
        <label for="address">Address: </label>
        <input type="text" name="address" class="form-control" id="address" placeholder="Address">
    </div>

    <div class="form-group">
        <label for="phone">Phone: </label>
        <input name="phone" class="form-control" type="tel" id="phone" placeholder="072-123-45-57">
    </div>

    <div class="form-group">
        <label for="comment">Comment: </label>
        <textarea name="comment" class="form-control" id="comment" placeholder="Comment"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Add</button>
</form>

