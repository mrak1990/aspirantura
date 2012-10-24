<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('department_id')); ?>:</b>
    <?php echo CHtml::encode($data->department_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('fio')); ?>:</b>
    <?php echo CHtml::encode($data->fio); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('birth')); ?>:</b>
    <?php echo CHtml::encode($data->birth); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('academic_position_id')); ?>:</b>
    <?php echo CHtml::encode($data->academic_position_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('administrative_position_id')); ?>:</b>
    <?php echo CHtml::encode($data->administrative_position_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('scientific_rank_id')); ?>:</b>
    <?php echo CHtml::encode($data->scientific_rank_id); ?>
    <br/>

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	*/ ?>

</div>