<?php

class ThesisBoardController extends Controller
{
    /**
     * @var string title of current page
     */
    public $pageTitle = 'Диссертационные советы';
    public $breadcrumbs = array(
        'Диссертационные советы' => array('index')
    );

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array();
    }

//    public function actions()
//    {
//        return array(
//            'search' => array(
//                'class' => 'application.components.actions.SearchAction',
//                'model' => Candidate::model(),
//                'labelField' => 'title',
//                'searchField' => 'title',
//            ),
//            'optionList' => array(
//                'class' => 'application.components.actions.ListAction',
//                'model' => Candidate::model(),
//                'labelField' => 'title',
//                'parentIdField' => 'foreign_key_id',
//            ),
//        );
//    }

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
        $model = new ThesisBoard();

        if (isset($_POST['ThesisBoard']))
        {
            $model->attributes = $_POST['ThesisBoard'];
            if ($model->save())
            {
                if (isset($_POST['Member']) && is_array($_POST['Member']))
                    $model->updateMembers($_POST['Member']);

                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
            }
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

        if (isset($_POST['ThesisBoard']))
        {
            $model->attributes = $_POST['ThesisBoard'];
            if ($model->save())
            {
                if (isset($_POST['Member']) && is_array($_POST['Member']))
                    $model->updateMembers($_POST['Member']);
                else
                    $model->updateMembers(array());

                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
            }
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
                    {
                        $model = $this->loadModel($id);
                        $model->delete();
                    }
                }
                Yii::app()->end();
            }
            else
            {
                $model = $this->loadModel($id);
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
        $model = new ThesisBoard('search');
        $search = new SortForm;

        if (isset($_GET['ThesisBoard']))
            $model->attributes = $_GET['ThesisBoard'];

        if (isset($_GET['SortForm']))
            $search->attributes = $_GET['SortForm'];

        $search->resolveGETSort();

        $scopes = $model->scopes();
        $criteria = new CDbCriteria($scopes['default']);

        $sort = new CSort('ThesisBoard');
        $sort->attributes = $model->getSortAttributes();
        $sort->defaultOrder = 't.code';

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
        $model = ThesisBoard::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'thesis-board-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
