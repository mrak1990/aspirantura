<?php $this->beginContent('//layouts/main'); ?>
<?php
$this->widget('bootstrap.widgets.BootBreadcrumbs', array(
    'links' => $this->breadcrumbs,
    'homeLink' => array(
        'label' => 'Главная',
        'url' => Yii::app()->homeUrl,
    ),
));
?>
<?php
$this->widget('MyBootMenu', array(
    'type' => 'tabs',
    'items' => $this->menu,
));
?>
<div class="row">
    <div class="span12">
        <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
        <?php echo $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>
