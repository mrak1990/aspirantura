<?php
/**
 * @var ThesisBoard $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge($this->breadcrumbs, array(
    'Добавление',
));

$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model);
?>

<h2>Добавление</h2>

<?php
echo $this->renderPartial('_form', array(
    'model' => $model,
));
?>