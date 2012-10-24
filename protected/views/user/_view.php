<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->username), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('password_hash')); ?>:</b>
    <?php echo CHtml::encode($data->password_hash); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
    <?php echo CHtml::encode($data->first_name); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
    <?php echo CHtml::encode($data->last_name); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('middle_name')); ?>:</b>
    <?php echo CHtml::encode($data->middle_name); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('fio')); ?>:</b>
    <?php echo CHtml::encode($data->fio); ?>
    <br/>


</div>