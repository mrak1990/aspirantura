<?php
/**
 * @var Controller $this
 */

$this->pageTitle = Yii::app()->name;
?>


<?php
if (Yii::app()->user->isGuest)
{
    echo 'Для доступа к частям базы нужно иметь учётную запись, обладающую необходимыми правами доступа. Пожалуйста войдите под своей учётной записью.';
    $this->renderPartial('login/_form', array(
        'model' => new LoginForm
    ));
}
else
{
    ?>
<div class="hero-unit" style="padding: 20px;">
    <h2><?php echo Yii::app()->name; ?></h2>
</div>
<?php
    echo '<div style="padding: 8px 0;" class="well">';
    $this->widget('bootstrap.widgets.BootMenu', array(
        'type' => 'pills',
        'stacked' => true,
        'items' => array(
            array(
                'label' => 'Факультеты',
                'url' => array('faculty/index')
            ),
            array(
                'label' => 'Кафедры',
                'url' => array('department/index')
            ),
            array(
                'label' => 'Сотрудники',
                'url' => array('staff/index')
            ),
            array(
                'label' => 'Аспиранты',
                'url' => array('candidate/index')
            ),
            array(
                'label' => 'Диссертационные советы',
                'url' => array('thesisBoard/index')
            ),
            array(
                'label' => 'Отрасли науки',
                'url' => array('scienceBranch/index')
            ),
            array(
                'label' => 'Специальности',
                'url' => array('speciality/index')
            ),
        ),
        'htmlOptions' => array(
            'style' => 'margin-bottom: 0'
        )
    ));
    echo '</div>';
}

$userId = Yii::app()->user->id;
$userControlPerm = Yii::app()->authManager->checkAccess('userControl', $userId);
$authItemControlPerm = Yii::app()->authManager->checkAccess('authItemControl', $userId);

if ($userControlPerm || $authItemControlPerm)
{
    echo '<div style="padding: 8px 0;" class="well">';
    $this->widget('bootstrap.widgets.BootMenu', array(
        'type' => 'list',
        'items' => array(
            array('label' => 'Администрирование'),
            array(
                'label' => 'Пользователи',
                'icon' => 'user',
                'url' => array('user/index'),
                'visible' => $userControlPerm,
            ),
            array(
                'label' => 'Права доступа',
                'icon' => 'hand-right',
                'url' => array('authItem/index'),
                'visible' => $authItemControlPerm,
            )
        ),
    ));
    echo '</div>';
}
?>

