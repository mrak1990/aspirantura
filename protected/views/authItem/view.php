<?php
$this->breadcrumbs = array_merge($breadcrumbsInit, array(
    $model->name,
));

$this->menu = array(
    array('label' => 'Все записи', 'icon' => 'list', 'url' => array('index')),
    array('label' => 'Добавить запись', 'icon' => 'plus', 'url' => array('create')),
    array('label' => 'Исправить эту запись', 'icon' => 'pencil', 'url' => array('update', 'name' => $model->name)),
    array('label' => 'Удалить эту запись', 'icon' => 'trash', 'url' => '#', 'linkOptions' => array(
        'submit' => array('delete', 'name' => $model->name),
        'confirm' => 'Вы действительно хотите удалить эту запись?'
    )),
    array('label' => 'Администрирование', 'icon' => 'cog', 'url' => array('admin')),
);

Yii::import('application.components.HelperHTML');
$helperRun = function ($data)
{
    return HelperHTML::spoiler($data, Yii::app()->params['auth']['spoilerMax'], 'authItem/view', 'name');
};

$children = array(
    array(
        'label' => 'Операции',
        'value' => $helperRun($model->children['operations']),
        'type' => 'html',
    ),
);
if ($model->type >= 1)
    $children[] = array(
        'label' => 'Задачи',
        'value' => $helperRun($model->children['tasks']),
        'type' => 'html',
    );
if ($model->type === 2)
    $children[] = array(
        'label' => 'Роли',
        'value' => $helperRun($model->children['roles']),
        'type' => 'html',
    );

$parents = array(
    array(
        'label' => 'Роли',
        'value' => $helperRun($model->parents['roles']),
        'type' => 'html',
    ),
);
if ($model->type <= 1)
    $parents[] = array(
        'label' => 'Задачи',
        'value' => $helperRun($model->parents['tasks']),
        'type' => 'html',
    );
if ($model->type === 0)
    $parents[] = array(
        'label' => 'Операции',
        'value' => $helperRun($model->parents['operations']),
        'type' => 'html',
    );

$users = array(
    array(
        'label' => 'Пользователи',
        'value' => HelperHTML::spoiler($model->users, Yii::app()->params['auth']['spoilerMax'], 'user/view'),
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
