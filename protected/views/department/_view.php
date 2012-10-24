<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('faculty_id')); ?>:</b>
    <?php echo CHtml::encode($data->faculty_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('number')); ?>:</b>
    <?php echo CHtml::encode($data->number); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::encode($data->title); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('staff_id')); ?>:</b>
    <?php echo CHtml::encode($data->staff_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
    <?php echo CHtml::encode($data->deleted); ?>
    <br/>


</div>