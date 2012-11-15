<?php
/**
 * @var AuthItem $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array($model->name)
);

$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model, 'name');

$this->renderPartial('_info', array(
    'model' => $model,
    'title' => 'Просмотр записи',
));

$spoilerMax = Yii::app()->params['auth']['spoilerMax'];
$authItemChildren = $model->children;
$authItemParents = $model->parents;

$children = array(
    array(
        'label' => 'Операции',
        'value' => HelperHTML::spoiler($authItemChildren['operations'], 20, 'authItem/view'),
        'type' => 'html',
    ),
);
if ($model->type >= 1)
    $children[] = array(
        'label' => 'Задачи',
        'value' => HelperHTML::spoiler($authItemChildren['tasks'], 20, 'authItem/view'),
        'type' => 'html',
    );
if ($model->type === 2)
    $children[] = array(
        'label' => 'Роли',
        'value' => HelperHTML::spoiler($authItemChildren['roles'], 20, 'authItem/view'),
        'type' => 'html',
    );

$parents = array(
    array(
        'label' => 'Роли',
        'value' => HelperHTML::spoiler($authItemParents['roles'], 20, 'authItem/view'),
        'type' => 'html',
    ),
);
if ($model->type <= 1)
    $parents[] = array(
        'label' => 'Задачи',
        'value' => HelperHTML::spoiler($authItemParents['tasks'], 20, 'authItem/view'),
        'type' => 'html',
    );
if ($model->type === 0)
    $parents[] = array(
        'label' => 'Операции',
        'value' => HelperHTML::spoiler($authItemParents['operations'], 20, 'authItem/view'),
        'type' => 'html',
    );

$users = array(
    array(
        'label' => 'Пользователи',
        'value' => HelperHTML::spoiler($model->users, 20, 'user/view', 'id'),
        'type' => 'html',
    ),
);
?>

<?php
$this->widget('ext.bootstrap.widgets.BootDetailView', array(
    'data' => $model,
    'attributes' => array(
        'name',
        array(
            'label' => 'Тип',
            'value' => AuthItem::$types[$model->type],
            'type' => 'text',
        ),
        'description',
        'bizrule',
    ),
));
?>

<h3>Пользователи
    <small>Могут выполнять действия, связанные с данным элементом авторизации</small>
</h3>
<?php
$this->widget('ext.bootstrap.widgets.BootDetailView', array(
    'data' => $model,
    'attributes' => $users,
));

?>

<h3>Наследники
    <small>Элементы авторизации, обладающие теми же правами, что и этот элемент</small>
</h3>
<?php
$this->widget('ext.bootstrap.widgets.BootDetailView', array(
    'data' => $model,
    'attributes' => $children,
));
?>

<h3>Родители
    <small>Элементы авторизации, правами которых обладает этот элемент</small>
</h3>
<?php
$this->widget('ext.bootstrap.widgets.BootDetailView', array(
    'data' => $model,
    'attributes' => $parents,
));
?>
