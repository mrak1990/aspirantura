<?php $this->beginContent('//layouts/main'); ?>
<?php
$this->widget('bootstrap.widgets.BootBreadcrumbs', array(
    'links' => $this->breadcrumbs,
));
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#">Поиск</a></li>
    <li><a href="#"><i class="icon-plus"></i> Добавление</a></li>
    <li><a href="#">Корзина</a></li>
    <li class="dropdown pull-right">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Управление <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="#">Изменить</a></li>
            <li><a href="#">В корзину</a></li>
            <li><a href="#">Удалить</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
        </ul>
    </li>
</ul>
<div class="row">
    <div class="span9">
        <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
        <?php echo $content; ?>
    </div>
    <div class="span3">
        <div class="well" style="padding: 2px 0;">
            <?php
            array_unshift($this->menu, array('label' => 'Действия'));
            $this->widget('bootstrap.widgets.BootMenu', array(
                'type' => 'list',
                'items' => $this->menu,
            ));
            ?>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>
