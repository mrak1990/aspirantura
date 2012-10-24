<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label = $this->pluralize($this->class2id($this->modelClass));
$id = $this->class2id($this->modelClass);
?>

$this->breadcrumbs = array_keys($this->breadcrumbs);
$this->menu = array(
array('label' => 'Поиск', 'url' => array('index'), 'icon' => 'search', 'itemOptions' => array('title' => 'Поиск и фильтрация записей')),
array('label' => 'Добавить', 'url' => array('create'), 'icon' => 'plus', 'itemOptions' => array('title' => 'Добавление новой записи')),
array('label' => 'Корзина', 'url' => array('trash'), 'icon' => 'trash', 'itemOptions' => array('title' => 'Просмотр записей в корзине')),
array('label' => 'Параметры', 'icon' => 'cog', 'itemOptions' => array(
'class' => 'pull-right',
'title' => 'Параметры вывода'
),
'items' => array(
),
));
?>

<?php echo "<?php "; ?>
$this->renderPartial('_search', array(
'model' => $model,
'searchModel' => $searchModel,
));
?>

<?php echo "<?php"; ?> $this->widget('MyBootGridView', array(
'id' => '<?php echo $id; ?>-grid',
'type' => 'striped bordered condensed',
'dataProvider' => new CActiveDataProvider($model, array(
'criteria' => $criteria,
'sort' => $sort,
'pagination' => array(
'pageSize' => 5,
),
)),
'enableSorting' => false,
'columns' => array(
'checbox' => array(
'class' => 'CCheckBoxColumn',
'id' => 'checkboxes',
'selectableRows' => 2,
),
'id',
'title' => array(
'header' => 'Название',
'name' => 'title',
'value' => 'CHtml::link($data->title, array("view", "id"=>$data->id))',
'type' => 'html',
),
array(
'header' => 'Название отношения',
'name' => 'relation_name_sort',
'value' => '(isset($data->relation_name)) ? $data->relation_name->attribute : null'
),
),
'footer' => array(
'prepend' => 'С отмеченными: ',
'class' => 'action-footer',
'items' => array(
array(
'value' => CHtml::ajaxLink('В корзину', array('toTrash', 'id' => 'many'), array(
'type' => 'POST',
'data' => 'js:{ids : $.fn.yiiGridView.getChecked("<?php echo $id; ?>-grid", "checkboxes")}',
'success' => 'js:$.fn.yiiGridView.update("<?php echo $id; ?>-grid")',
'error' => 'js:function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}',
)
),
'visible' => $this->action->id === 'index',
),
array(
'value' => CHtml::ajaxLink('Восстановить', array('restore', 'id' => 'many'), array(
'type' => 'POST',
'data' => 'js:{ids : $.fn.yiiGridView.getChecked("<?php echo $id; ?>-grid", "checkboxes")}',
'success' => 'js:$.fn.yiiGridView.update("<?php echo $id; ?>-grid")',
'error' => 'js:function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}',
)
),
'visible' => $this->action->id === 'trash',
),
array(
'value' => CHtml::ajaxLink('Удалить', array('delete', 'id' => 'many'), array(
'type' => 'POST',
'data' => 'js:{ids : $.fn.yiiGridView.getChecked("faculty-grid", "checkboxes")}',
'success' => 'js:$.fn.yiiGridView.update("faculty-grid")',
'error' => 'js:function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}',
), array(
'confirm' => 'Вы действительно хотите везвозвратно удалить отмеченные записи?',
)
),
'visible' => $this->action->id === 'trash',
),
),
),
)); ?>
