<?php
/**
 * @var CandidateStatForm $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array(
        'Статистика',
    ));

$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model);
?>

<div style="margin-top: -5px; padding-bottom: 15px;">
    <small><em>
        Укажите параметры фильтрации соискателей.
        Например, чтобы найти соискателей на степень кандидата наук, которые защитились более чем через 3 года после
        поступления, следует указать параметры <code>доктора</code>, <code>да</code>, <code>нет</code></em></small>
</div>

<?php
$this->renderPartial('stat/_form', array(
    'model' => $model,
));
?>

<?php if (isset($count)): ?>
<h4>Число соискателей, удовлетворяющих условиям: <?php echo $count ?></h4>
<?php endif; ?>