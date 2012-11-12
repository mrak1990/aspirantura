<?php

class MemberController extends Controller
{
    /**
     * @var string title of current page
     */
    public $pageTitle = 'Сотрудники';

    public $breadcrumbs = array(
        'Сотрудники' => array('index')
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
                'model' => Member::model(),
                'labelField' => 'fio',
                'searchField' => 'fio',
            ),
            'optionList' => array(
                'class' => 'application.components.actions.ListAction',
                'model' => Member::model(),
                'labelField' => 'fio',
                'parentIdField' => 'department_id',
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
        $model = new Member;

        if (isset($_POST['Member']))
        {
            $model->attributes = $_POST['Member'];
            if ($model->save())
            {
                if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status' => 'success',
                        'div' => "Сотрудник успешно добавлен",
                        'data' => array(
                            'value' => $model->id,
                            'title' => $model->fio,
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
                $model->fio = mb_convert_case($_POST['title'], MB_CASE_TITLE, 'UTF-8');
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Member']))
        {
            $model->attributes = $_POST['Member'];
            if ($model->save())
            {
                if (isset($_POST['ScienceDegree']) && is_array($_POST['ScienceDegree']))
                    $model->updateScienceDegrees($_POST['ScienceDegree']);
                else
                    $model->updateScienceDegrees(array());

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
        $model = new Member('search');
        $search = new SortForm;

        if (isset($_GET['Member']))
            $model->attributes = $_GET['Member'];

        if (isset($_GET['SortForm']))
            $search->attributes = $_GET['SortForm'];

        $search->resolveGETSort();

        $model->resetScope(true);
        $criteria = new CDbCriteria(array(
            'with' => array(
                'department' => array(
                    'with' => array(
                        'faculty'
                    ),
                )
            )
        ));

        $sort = new CSort('Member');
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
        $model = new Member('search');
        $search = new SortForm;

        if (isset($_GET['Member']))
            $model->attributes = $_GET['Member'];

        if (isset($_GET['SortForm']))
            $search->attributes = $_GET['SortForm'];

        $search->resolveGETSort();

        $criteria = new CDbCriteria(array(
            'with' => array(
                'department' => array(
                    'with' => array(
                        'faculty'
                    ),
                )
            )
        ));

        $sort = new CSort('Member');
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
        $model = Member::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'member-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}