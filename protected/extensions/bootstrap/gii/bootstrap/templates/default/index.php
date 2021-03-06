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

/**
* @var <?php echo $this->model ?> $model
* @var SortForm $searchModel
* @var CDbCriteria $criteria
* @var CSort $sort
* @var Controller $this
*/

$this->breadcrumbs = array_keys($this->breadcrumbs);
$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'));

$this->renderPartial('_search', array(
'model' => $model,
'searchModel' => $searchModel,
));

$valueFunction = function ($data)
{
return Yii::app()->controller->widget("ext.bootstrap.widgets.BootButtonGroup", array(
"size" => "mini",
"buttons" => array(
array(
"items" => array(
array(
"label" => "ссылка",
"url" => array(
"#",
"Department[faculty_id][]" => $data->id
)
),
"---",
array(
"label" => "что-то ещё",
"url" => "#"
),
)
),
),
), true);
};

$this->widget('MyBootGridView', array(
'id' => '<?php echo $id; ?>-grid',
'type' => 'striped bordered condensed',
'dataProvider' => new CActiveDataProvider($model, array(
'criteria' => $criteria,
'sort' => $sort,
'pagination' => array( //            'pageSize' => 5,
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
'value' => 'CHtml::link("$data->fullTitle", array("view", "id"=>$data->id))',
'type' => 'html',
),
array(
'class' => 'ext.bootstrap.widgets.BootButtonColumn',
'htmlOptions' => array('style' => 'width: 50px'),
),
array(
'class' => 'CDataColumn',
'type' => 'raw',
'value' => $valueFunction,
'htmlOptions' => array(
'style' => 'width: 20px'
),
),
),
'footer' => array(
'prepend' => 'С отмеченными: ',
'class' => 'action-footer',
'items' => $model->getFooterItems(),
),
));

?>
