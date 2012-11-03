<?php

class CandidateController extends Controller
{
    /**
     * @var string title of current page
     */
    public $pageTitle = 'Аспиранты';
    public $breadcrumbs = array(
        'Аспиранты' => array('index')
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
                'model' => Candidate::model(),
                'labelField' => 'title',
                'searchField' => 'title',
            ),
            'optionList' => array(
                'class' => 'application.components.actions.ListAction',
                'model' => Candidate::model(),
                'labelField' => 'title',
                'parentIdField' => 'foreign_key_id',
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
        $model = new Candidate;

        if (isset($_POST['Candidate']))
        {
            $model->attributes = $_POST['Candidate'];
            if ($model->save())
            {
                if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status' => 'success',
                        'div' => "Запись успешно добавлена",
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
                ), true)
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

        if (isset($_POST['Candidate']))
        {
            $model->attributes = $_POST['Candidate'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
                $this->redirect(Yii::app()->request->getUrlReferrer());
            else
                Yii::app()->end();
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
                $this->redirect(Yii::app()->request->getUrlReferrer());
            else
                Yii::app()->end();
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
            if ($id === 'many')
            {
                if (isset($_POST['ids']) && is_array($_POST['ids']))
                {
                    foreach ($_POST['ids'] as $id)
                    {
                        $model = $this->loadModel($id);
//                        $model->deleteScienceDegrees();
                        $model->delete();
                    }
                }
                Yii::app()->end();
            }
            else
            {
                $model = $this->loadModel($id);
//                $model->deleteScienceDegrees();
                $model->delete();
            }

            if (!isset($_GET['ajax']))
                $this->redirect($this->createUrl('trash'));
        }
        else
            throw new CHttpException(400, 'Неверный запрос. Пожалуйста, не повторяйте этот запрос.');
    }

    /**
     * Lists all undeleted models.
     */
    public function actionIndex()
    {
        $model = new Candidate('search');
        $search = new SortForm;

        if (isset($_GET['Candidate']))
            $model->attributes = $_GET['Candidate'];

        if (isset($_GET['SortForm']))
            $search->attributes = $_GET['SortForm'];

        $search->resolveGETSort();

        $criteria = new CDbCriteria(array(
            'with' => array(
                'department' => array(
                    'with' => array(
                        'faculty'
                    ),
                ),
                'advisor',
            )
        ));

        $sort = new CSort('Candidate');
        $sort->attributes = $model->getSortAttributes();
        $sort->defaultOrder = 't.fio';

        $this->render('index', array(
            'model' => $model->getRestoredRecords()->search(),
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
        $model = new Candidate('search');
        $search = new SortForm;

        if (isset($_GET['Candidate']))
            $model->attributes = $_GET['Candidate'];

        if (isset($_GET['SortForm']))
            $search->attributes = $_GET['SortForm'];

        $search->resolveGETSort();

        $criteria = new CDbCriteria(array(
            'with' => array(
                'department' => array(
                    'with' => array(
                        'faculty'
                    ),
                ),
                'advisor',
            )
        ));

        $sort = new CSort('Candidate');
        $sort->attributes = $model->getSortAttributes();
        $sort->defaultOrder = 't.fio';

        $this->render('index', array(
            'model' => $model->getDeletedRecords()->search(),
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
        $model = Department::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'candidate-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
