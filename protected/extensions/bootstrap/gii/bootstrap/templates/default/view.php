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
?>

/**
* @var <?php echo $this->model ?> $model
* @var Controller $this
*/

$this->breadcrumbs = array_merge(
$this->breadcrumbs,
array($model->title)
);
$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model);

$this->renderPartial('_info', array(
'model' => $model,
'title' => 'Просмотр записи',
)
);


$this->widget('ext.bootstrap.widgets.BootDetailView', array(
'data' => $model,
'attributes' => array(
<?php
foreach ($this->tableSchema->columns as $column)
    echo "\t\t'" . $column->name . "',\n";
?>
),
)
);

?>
