<?php

class AuthItemController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $breadcrumbs = array('Права доступа' => array('index'),);

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array( //            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     *
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($name)
    {
        $this->render('view', array(
            'model' => $this->loadModel($name),
            'breadcrumbsInit' => $this->breadcrumbs,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new AuthItem;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['AuthItem']))
        {
            $model->attributes = array_merge_recursive($model->emptyPostData, $_POST['AuthItem']);

            if ($model->validate())
            {
                $auth = Yii::app()->authManager;
                $model->authItem = $auth->createAuthItem($model->name, $model->type, $model->description);

                if ($model->authItem !== null)
                {
//                    foreach ($model->mergeChild() as $item)
//                        $model->authItem->addChild($item);
//
//                    foreach ($model->mergeParents() as $item)
//                        $model->authItem->addChild($item);
//
//                    foreach ($model->users as $item)
//                        $model->authItem->assign($item);
                    $model->updateChildrenAndParents();
                    $model->updateUsers();

                    $this->redirect(array('view', 'name' => $model->name));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
            'breadcrumbsInit' => $this->breadcrumbs,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($name)
    {
        $model = $this->loadModel($name);

        // logging an INFO message (arrays will work and looks awesome in FirePHP)
        Yii::log(array('username' => 'Shiki', 'profiles' => array('twidl', 'twitter', 'facebook')), CLogger::LEVEL_INFO);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['AuthItem']))
        {
            $model->attributes = array_merge_recursive($model->emptyPostData, $_POST['AuthItem']);

            if ($model->validate())
            {
                $model->authItem = Yii::app()->authManager->getAuthItem($name);

                if ($model->authItem !== null)
                {
                    $model->authItem->setName($model->name);
                    $model->authItem->setDescription($model->description);

                    $model->updateChildrenAndParents();
                    $model->updateUsers();

                    $this->redirect(array('view', 'name' => $model->name));
                }
            }
            else
                $this->render('update', array(
                    'model' => $model,
                    'breadcrumbsInit' => $this->breadcrumbs,
                ));
        }

        $this->render('update', array(
            'model' => $model,
            'breadcrumbsInit' => $this->breadcrumbs,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($name)
    {
        if (Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $auth = Yii::app()->authManager;
            $auth->removeAuthItem($name);

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl'])
                    ? $_POST['returnUrl']
                    : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('AuthItem');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'breadcrumbsInit' => $this->breadcrumbs,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new AuthItem('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['AuthItem']))
            $model->attributes = $_GET['AuthItem'];

        $this->render('admin', array(
            'model' => $model,
            'breadcrumbsInit' => $this->breadcrumbs,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($name)
    {
        $model = AuthItem::model()->findByPk($name);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'auth-item-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
