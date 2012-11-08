<?php
/**
 * @var User $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array("{$model->username} ({$model->fio})")
);
$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model);

//$this->renderPartial('_info', array(
//    'model' => $model,
//    'title' => 'Просмотр записи',
//));

//$this->widget('ext.bootstrap.widgets.BootDetailView', array(
//        'data' => $model,
//        'attributes' => array(
//            'id',
//            'username',
//            'first_name',
//            'middle_name',
//            'last_name',
//            'email',
//        ),
//    )
//);
?>
<?php
echo $form->textFieldRow($model, 'first_name', array(
    'class' => 'span5',
    'maxlength' => 30,
    'hint' => 'Введите имя',
));
?>

<?php
echo $form->textFieldRow($model, 'middle_name', array(
    'class' => 'span5',
    'maxlength' => 30,
    'hint' => 'Введите отчество',
));
?>

<?php
echo $form->textFieldRow($model, 'last_name', array(
    'class' => 'span5',
    'maxlength' => 30,
    'hint' => 'Введите фамилию',
));
?>

<?php
echo $form->textFieldRow($model, 'email', array(
    'class' => 'span5',
    'maxlength' => 30,
    'hint' => 'Введите электронную почту',
));
?>