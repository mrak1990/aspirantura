<?php
/**
 * @var $form MyBootActiveForm
 * @var $model LoginForm
 * @var $this CController
 */

$this->breadcrumbs = array_merge($this->breadcrumbs, array(
    'Авторизация',
));
?>

<h2>Авторизация</h2>

<?php
echo $this->renderPartial('login/_form', array(
    'model' => $model
));
?>