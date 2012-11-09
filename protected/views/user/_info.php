<?php
/**
 * @var User $model
 * @var Controller $this
 * @var string $title
 */
?>

<h2 style="display: inline;">
    <?php
    echo $title;
    ?>
</h2>
<div class="pull-right">
    <?php
    echo call_user_func(User::getSubModelMenuFunction(), $model);
    ?>
</div>
