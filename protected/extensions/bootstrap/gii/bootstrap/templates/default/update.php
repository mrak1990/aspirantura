<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn = $this->guessNameColumn($this->tableSchema->columns);
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array_merge(\$this->breadcrumbs, array(
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Редактирование',
));\n";
?>

$this->menu = array(
array('label' => 'Поиск', 'url' => array('index'), 'icon' => 'search', 'itemOptions' => array('title' => 'Поиск и фильтрация записей')),
array('label' => 'Добавить', 'url' => array('create'), 'icon' => 'plus', 'itemOptions' => array('title' => 'Добавление новой записи')),
array('label' => 'Корзина', 'url' => array('trash'), 'icon' => 'trash', 'itemOptions' => array('title' => 'Просмотр записей в корзине')),
//    array('label' => 'Администрирование', 'icon' => 'cog', 'url' => array('admin')),
array('label' => 'Действия', 'icon' => 'cog', 'itemOptions' => array(
'class' => 'pull-right',
'title' => 'Действия над записью'
),
'items' => array(
array('label' => 'В корзину', 'url' => '#', 'visible' => !$model->deleted, 'icon' => 'trash', 'linkOptions' => array(
'submit' => array('toTrash', 'id' => $model->id),
),
),
array('label' => 'Восстановить', 'url' => '#', 'visible' => $model->deleted, 'icon' => 'ok-circle', 'linkOptions' => array(
'submit' => array('restore', 'id' => $model->id),
),
),
array('label' => 'Удалить', 'url' => '#', 'visible' => $model->deleted, 'icon' => 'remove', 'linkOptions' => array(
'submit' => array('delete', 'id' => $model->id),
'confirm' => 'Вы действительно хотите безвозвратно удалить эту запись?',
),
),
),
),
array('label' => 'Редактирование', 'url' => array('update', 'id' => $model->id), 'icon' => 'edit', 'itemOptions' => array(
'class' => 'pull-right',
'title' => 'Редактирование записи'
)),
array('label' => 'Просмотр', 'url' => array('view', 'id' => $model->id), 'icon' => 'th-list', 'itemOptions' => array(
'class' => 'pull-right',
'title' => 'Простотр записи'
)),
);
?>

<h2>Редактирование</h2>

<?php echo "<?php echo \$this->renderPartial('_form',array('model'=>\$model)); ?>"; ?>