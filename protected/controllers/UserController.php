<?php

class UserController extends Controller
{
    /**
     * @var string title of current page
     */
    public $pageTitle = 'Пользователи';

    public $breadcrumbs = array(
        'Пользователи' => array('index')
    );

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array( //			'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Displays a particular model.
     *
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User']))
        {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['User']))
        {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl'])
                    ? $_POST['returnUrl']
                    : array('admin'));
        }
        else
            throw new CHttpException(400, 'Неверный запрос. Пожалуйста, не повторяйте этот запрос.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new User('search');
        $search = new SortForm;

        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        if (isset($_GET['SortForm']))
            $search->attributes = $_GET['SortForm'];

        $search->resolveGETSort();

        $criteria = new CDbCriteria(array( //            'with' => array('dean')
        ));

        $sort = new CSort('User');
        $sort->attributes = $model->getSortAttributes();
        $sort->defaultOrder = 't.username';

        $this->render('index', array(
            'model' => $model->search(),
            'criteria' => $criteria,
            'sort' => $sort,
            'searchModel' => $search,
        ));
    }

    /**
     * Set new password for user
     *
     * @param integer $id the ID of the model
     */
    public function actionNewPassword($id)
    {
        $model = $this->loadModel($id);
        $model->scenario = 'newPassword';

        if (isset($_POST['User']) && isset($_POST['User']['password']))
        {
            $model->attributes = array('password' => $_POST['User']['password']);
            if ($model->save())
                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
        }

        $this->render('newPassword', array(
            'model' => $model,
        ));
    }

    /**
     * Set new password for user
     *
     * @param integer $id the ID of the model
     */
    public function actionChangeUsername($id)
    {
        $model = $this->loadModel($id);
        $model->scenario = 'changeUsername';

        if (isset($_POST['User']) && isset($_POST['User']['username']))
        {
            $model->attributes = array('username' => $_POST['User']['username']);
            if ($model->save())
                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
        }

        $this->render('changeUsername', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Страница не существует.');

        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
