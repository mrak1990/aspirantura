<?php

class ScienceBranchController extends Controller
{
    /**
     * @var string title of current page
     */
    public $pageTitle = 'Отрасли науки';
    public $breadcrumbs = array(
        'Отрасли науки' => array('index')
    );

    public function actions()
    {
        return array(
            'search' => array(
                'class' => 'application.components.actions.SearchAction',
                'model' => ScienceBranch::model(),
                'labelField' => 'title',
                'searchField' => 'title',
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
        $model = new ScienceBranch;

        if (isset($_POST['ScienceBranch']))
        {
            $model->attributes = $_POST['ScienceBranch'];
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
                $model->full_title = $_POST['title'];
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

        if (isset($_POST['ScienceBranch']))
        {
            $model->attributes = $_POST['ScienceBranch'];
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
            if ($id === 'many')
            {
                if (isset($_POST['ids']) && is_array($_POST['ids']))
                {
                    foreach ($_POST['ids'] as $id)
                        $this->loadModel($id)->delete();
                }
                Yii::app()->end();
            }
            else
                $this->loadModel($id)->delete();

            if (!isset($_GET['ajax']))
                $this->redirect($this->createUrl('index'));
        }
        else
            throw new CHttpException(400, 'Неверный запрос. Пожалуйста, не повторяйте этот запрос.');
    }

    /**
     * Lists all undeleted models.
     */
    public function actionIndex()
    {
        $model = new ScienceBranch('search');
        $search = new SortForm;

        if (isset($_GET['ScienceBranch']))
            $model->attributes = $_GET['ScienceBranch'];

        if (isset($_GET['SortForm']))
            $search->attributes = $_GET['SortForm'];

        $search->resolveGETSort();

        $criteria = new CDbCriteria(array(
            'with' => array()
        ));

        $sort = new CSort('Department');
        $sort->attributes = $model->getSortAttributes();
        $sort->defaultOrder = 't.title';

        $this->render('index', array(
            'model' => $model->search(),
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
        $model = ScienceBranch::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'science-branch-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
