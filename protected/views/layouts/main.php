<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
//        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/bootstrap.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/mine.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/mine.css');
//        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/bootstrap-responsive.css');
    ?>

    <!--        <link rel="stylesheet/less" type="text/css" href="http://127.0.0.1/git/asp_test/css/bootswatch.less">-->

    <!--        <script src="http://127.0.0.1/git/asp_test/css/less-1.3.0.min.js" type="text/javascript"></script>-->
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <a class="brand" href="#">АСиДС</a>

        <div class="container">
            <ul class="nav">
                <li class="active">
                    <a href="#">Главная</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Действия
                        <b class="caret"></b>
                    </a>
                    <!--                            <ul class="dropdown-menu">
                                                    <li><a href="#">Добавить пользователя</a></li>
                                                    <li><a href="#">Удалить пользователя</a></li>
                                                    <li><a href="#">Список пользователей</a></li>
                                                </ul>-->
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Добавить пользователя', 'url' => array('/user/create')),
                            array('itemOptions' => array('class' => 'divider')),
                            array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                            array('label' => 'Contact', 'url' => array('/site/contact')),
                            array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                        ),
                        'htmlOptions' => array(
                            'class' => 'dropdown-menu',
                        )
                    ));
                    ?>

                </li>
            </ul>
            <ul class="nav pull-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        mrak1990
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Настройки</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Выйти</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <?php echo $content; ?>
</div>
</body>
</html>