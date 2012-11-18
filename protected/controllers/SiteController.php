<?php

class SiteController extends Controller
{
    /**
     * @var string title of current page
     */
    public $pageTitle = '';

    public function filters()
    {
        return array();
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->homeUrl);

        $this->pageTitle = Yii::app()->name . ' | ' . 'Вход';

        $model = new LoginForm;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['LoginForm']))
        {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }

        $this->render('login/login', array(
            'model' => $model
        ));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        $this->pageTitle = Yii::app()->name . ' | ' . 'Выход';

        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Open profile for authorized user
     */
    public function actionProfile()
    {
        $this->pageTitle = Yii::app()->name . ' | ' . 'Профиль';

        if (Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->homeUrl);

//        CVarDumper::dump(Yii::app()->user->id, 10, true);
//        Yii::app()->end();

        $model = User::model()->findByPk(Yii::app()->user->id);

        $this->render('profile', array(
            'model' => $model,
        ));
    }
}