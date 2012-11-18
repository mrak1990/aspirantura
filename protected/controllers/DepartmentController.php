<?php

class DepartmentController extends Controller
{
    /**
     * @var string title of current page
     */
    public $pageTitle = 'Кафедры';

    public $breadcrumbs = array(
        'Кафедры' => array('index')
    );

    public function actions()
    {
        return array(
//            'search' => array(
//                'class' => 'application.components.actions.SearchAction',
//                'model' => Department::model(),
//                'labelField' => 'title',
//                'searchField' => 'title',
//            ),
            'optionList' => array(
                'class' => 'application.components.actions.ListAction',
                'model' => Department::model(),
                'labelField' => 'title',
                'parentIdField' => 'faculty_id',
                'emptyText' => 'Нет кафедр на данном факультете'
            ),
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
        $model = new Department;

        if (isset($_POST['Department']))
        {
            $model->attributes = $_POST['Department'];
            if ($model->save())
            {
                if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status' => 'success',
                        'div' => "Кафедра успешно добавлена",
                        'data' => array(
                            'value' => $model->id,
                            'title' => $model->title,
                        )
                    ));
                    Yii::app()->end();
                }
                else
                    $this->redirect(array(
                        'view',
                        'id' => $model->id
                    ));
            }
        }

        if (Yii::app()->request->isAjaxRequest)
        {
            if (isset($_POST['title']))
                $model->title = mb_convert_case($_POST['title'], MB_CASE_TITLE, 'UTF-8');
            echo CJSON::encode(array(
                'status' => 'failure',
                'div' => $this->renderPartial('_form', array(
                    'model' => $model
                ), true, true)
            ));
            Yii::app()->end();
        }
        else
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

        if (isset($_POST['Department']))
        {
            $model->attributes = $_POST['Department'];
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
     * Move a particular model to trash.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionToTrash(array $id)
    {
        foreach ($id as $value)
            $this->loadModel($value)->setDeleted()->save();

        if (isset($_GET['ajax']) || Yii::app()->request->isAjaxRequest)
            Yii::app()->end();
        else
            $this->redirect(array(
                'view',
                'id' => array_pop($id)
            ));
    }

    /**
     * Restore a particular model from trash.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionRestore(array $id)
    {
        foreach ($id as $value)
            $this->loadModel($value)->setRestored()->save();

        if (isset($_GET['ajax']) || Yii::app()->request->isAjaxRequest)
            Yii::app()->end();
        else
            $this->redirect(array(
                'view',
                'id' => array_pop($id)
            ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete(array $id)
    {
        foreach ($id as $value)
            $this->loadModel($value)->delete();

        if (isset($_GET['ajax']) || Yii::app()->request->isAjaxRequest)
            Yii::app()->end();
        else
            $this->redirect($this->createUrl('trash'));
    }

    /**
     * Lists all undeleted models.
     */
    public function actionIndex()
    {
        $model = new Department('search');
        $search = new SortForm;

        if (isset($_GET['Department']))
            $model->attributes = $_GET['Department'];

        if (isset($_GET['SortForm']))
            $search->attributes = $_GET['SortForm'];

        $search->resolveGETSort();

        $criteria = new CDbCriteria(array(
            'with' => array(
                'faculty',
                'head'
            )
        ));

        $sort = new CSort('Department');
        $sort->attributes = $model->getSortAttributes();
        $sort->defaultOrder = 't.title';

        $this->render('index', array(
            'model' => $model->restored()->search(),
            'criteria' => $criteria,
            'sort' => $sort,
            'searchModel' => $search,
        ));
    }

    /**
     * Lists all deleted models.
     */
    public function actionTrash()
    {
        $model = new Department('search');
        $search = new SortForm;

        if (isset($_GET['Department']))
            $model->attributes = $_GET['Department'];

        if (isset($_GET['SortForm']))
            $search->attributes = $_GET['SortForm'];

        $search->resolveGETSort();

        $criteria = new CDbCriteria(array(
            'with' => array(
                'faculty',
                'head'
            )
        ));

        $sort = new CSort('Department');
        $sort->attributes = $model->getSortAttributes();
        $sort->defaultOrder = 't.title';

        $this->render('index', array(
            'model' => $model->deleted()->search(),
            'criteria' => $criteria,
            'sort' => $sort,
            'searchModel' => $search,
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
        $model = Department::model()->resetScope()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'department-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
