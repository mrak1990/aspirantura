<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/mine.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/mine.css');
    ?>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="brand">АСиДС</div>
        <div class="container">
            <ul class="nav">
                <li class="active">
                    <?php echo CHtml::link('Главная', Yii::app()->homeUrl); ?>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Быстрый переход<b class="caret"></b>
                    </a>
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
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
                                'itemOptions' => array(
                                    'class' => 'divider'
                                )
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
                                'itemOptions' => array(
                                    'class' => 'divider'
                                )
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
                            'class' => 'dropdown-menu',
                        )
                    ));
                    ?>

                </li>
            </ul>
            <ul class="nav pull-right">
                <?php if (Yii::app()->user->isGuest): ?>
                <li>
                    <?php echo CHtml::link('Войти', array('site/login')); ?>
                </li>
                <?php else: ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php echo Yii::app()->user->name; ?>
                        <b class="caret"></b>
                    </a>
                    <?php
                    $userId = Yii::app()->user->id;
                    $userControlPerm = Yii::app()->authManager->checkAccess('userControl', $userId);
                    $authItemControlPerm = Yii::app()->authManager->checkAccess('authItemControl', $userId);

                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array(
                                'label' => 'Профиль',
                                'url' => array('site/profile'),
                            ),
                            array(
                                'label' => 'Выйти',
                                'url' => array('site/logout'),
                            ),
                            array(
                                'visible' => $userControlPerm || $authItemControlPerm,
                                'itemOptions' => array(
                                    'class' => 'divider'
                                )
                            ),
                            array(
                                'label' => 'Пользователи',
                                'url' => array('user/index'),
                                'visible' => $userControlPerm,
                            ),
                            array(
                                'label' => 'Права доступа',
                                'url' => array('authItem/index'),
                                'visible' => $authItemControlPerm,
                            )
                        ),
                        'htmlOptions' => array(
                            'class' => 'dropdown-menu',
                        )
                    ));
                    ?>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <?php echo $content; ?>
</div>
</body>
</html>