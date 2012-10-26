<?php

class DepartmentController extends Controller
{

    public $pageTitle = 'Кафедры';
    public $breadcrumbs = array(
        'Кафедры' => array('index')
    );

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array();
    }

    public function actions()
    {
        return array(
            'search' => array(
                'class' => 'application.components.actions.SearchAction',
                'model' => Department::model(),
                'labelField' => 'title',
                'searchField' => 'title',
            ),
            'optionList' => array(
                'class' => 'application.components.actions.ListAction',
                'model' => Department::model(),
                'labelField' => 'title',
                'parentIdField' => 'faculty_id',
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
            )
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Department;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Department']))
        {
            $model->attributes = $_POST['Department'];
            if ($model->save())
            {
                if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                            'status' => 'success',
                            'div' => "Факультет успешно добавлен",
                            'data' => array(
                                'value' => $model->id,
                                'title' => $model->title,
                            )
                        )
                    );
                    exit;
                }
                else
                    $this->redirect(array(
                            'view',
                            'id' => $model->id
                        )
                    );
            }
        }

        if (Yii::app()->request->isAjaxRequest)
        {
            if (isset($_POST['title']))
                $model->title = $_POST['title'];
            echo CJSON::encode(array(
                    'status' => 'failure',
                    'div' => $this->renderPartial('_form', array(
                        'model' => $model
                    ), true)
                )
            );
            exit;
        }
        else
            $this->render('create', array(
                    'model' => $model,
                )
            );
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Department']))
        {
            $model->attributes = $_POST['Department'];
            if ($model->save())
                $this->redirect(array(
                        'view',
                        'id' => $model->id
                    )
                );
        }

        $this->render('update', array(
                'model' => $model,
            )
        );
    }

    /**
     * Move a particular model to trash.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionToTrash($id)
    {
        if (Yii::app()->request->isPostRequest)
        {
            if ($id === 'many')
            {
                if (isset($_POST['ids']) && is_array($_POST['ids']))
                {
                    foreach ($_POST['ids'] as $id)
                        $this->loadModel($id)->setDeleted()->save();
                }
                Yii::app()->end();
            }
            else
                $this->loadModel($id)->setDeleted()->save();

            if (!isset($_GET['ajax']))
                $this->redirect(array(
                        'view',
                        'id' => $id
                    )
                );
        }
        else
            throw new CHttpException(400, 'Неверный запрос. Пожалуйста, не повторяйте этот запрос.');
    }

    /**
     * Restore a particular model from trash.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionRestore($id)
    {
        if (Yii::app()->request->isPostRequest)
        {
            if ($id === 'many')
            {
                if (isset($_POST['ids']) && is_array($_POST['ids']))
                {
                    foreach ($_POST['ids'] as $id)
                        $this->loadModel($id)->setRestored()->save();
                }
                Yii::app()->end();
            }
            else
                $this->loadModel($id)->setRestored()->save();

            if (!isset($_GET['ajax']))
                $this->redirect(array(
                        'view',
                        'id' => $id
                    )
                );
        }
        else
            throw new CHttpException(400, 'Неверный запрос. Пожалуйста, не повторяйте этот запрос.');
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
            $this->loadModel($id)->delete();

            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
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
            )
        );

        $sort = new CSort('Department');
        $sort->attributes = array(
            'head' => array(
                'asc' => 'head.fio',
                'desc' => 'head.fio DESC',
            ),
            'faculty' => array(
                'asc' => 'faculty.title',
                'desc' => 'faculty.title DESC',
            ),
            '*',
        );
        $sort->defaultOrder = 't.title';

        $this->render('index', array(
                'model' => $model->getRestoredRecords()->search(),
                'criteria' => $criteria,
                'sort' => $sort,
                'searchModel' => $search,
            )
        );
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
                'with' => array('head')
            )
        );

        $sort = new CSort('Department');
        $sort->attributes = array(
            'head' => array(
                'asc' => 'head.fio',
                'desc' => 'head.fio DESC',
            ),
            '*',
        );
        $sort->defaultOrder = 't.title';

        $this->render('index', array(
                'provider' => new CActiveDataProvider($model->getDeletedRecords()->search(), array(
                        'criteria' => $criteria,
                        'sort' => $sort,
                        'pagination' => array(
                            'pageSize' => 5,
                        ),
                    )
                ),
                'searchModel' => $search,
            )
        );
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Department('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Department']))
            $model->attributes = $_GET['Department'];

        $this->render('admin', array(
                'model' => $model,
            )
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Department::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'department-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
