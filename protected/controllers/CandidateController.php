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
        $disser = new Disser;

        if (isset($_POST['Candidate']) && isset($_POST['Disser']) && is_array($_POST['Disser']))
        {
            $model->attributes = $_POST['Candidate'];
            $disser->attributes = $_POST['Disser'];

            $valid1 = $model->validate();
            $valid2 = $disser->validate();
            if ($valid1 && $valid2)
            {
                $model->save(false);
                $model->updateDisser($_POST['Disser']);

                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'disser' => $disser,
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
        $disser = $model->disser;

        if (isset($_POST['Candidate']) && isset($_POST['Disser']) && is_array($_POST['Disser']))
        {
            $model->attributes = $_POST['Candidate'];
            $disser->attributes = $_POST['Disser'];

            $valid1 = $model->validate();
            $valid2 = $disser->validate();
            if ($valid1 && $valid2)
            {
                $model->save(false);
                $model->updateDisser($_POST['Disser']);

                $this->redirect(array(
                    'view',
                    'id' => $model->id
                ));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'disser' => $model->disser,
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
                        $model->deleteDisser();
                        $model->delete();
                    }
                }
                Yii::app()->end();
            }
            else
            {
                $model = $this->loadModel($id);
                $model->deleteDisser();
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

        $scopes = $model->scopes();
        $criteria = new CDbCriteria($scopes['default']);

        $sort = new CSort('Candidate');
        $sort->attributes = $model->getSortAttributes();
        $sort->defaultOrder = 't.fio';

        $this->render('index', array(
            'model' => $model->search(),
            'criteria' => $criteria,
            'sort' => $sort,
            'searchModel' => $search,
        ));
    }

    public function actionStat()
    {
        $formModel = new CandidateStatForm;

        if (isset($_GET['CandidateStatForm']))
        {
            $formModel->attributes = $_GET['CandidateStatForm'];
            if ($formModel->validate())
            {
                $model = new Candidate;

                if ($formModel->done === '1')
                    $tmpModel = $model->done();
                elseif ($formModel->done === '0')
                    $tmpModel = $model->undone();
                else
                    $tmpModel = $model;

                if ($formModel->doctor === '1')
                    $tmpModel = $tmpModel->doctor();
                elseif ($formModel->doctor === '0')
                    $tmpModel = $tmpModel->notDoctor();
                else
                    $tmpModel = $tmpModel;

                if ($formModel->inTime === '1')
                    $tmpModel = $tmpModel->inTime();
                elseif ($formModel->inTime === '0')
                    $tmpModel = $tmpModel->notInTime();
                else
                    $tmpModel = $tmpModel;

                $this->render('stat/stat', array(
                    'model' => $formModel,
                    'count' => $tmpModel->count(),
                ));
                Yii::app()->end();
//                $count['кандидатов в доктора наук, закончивших вовремя'] = Candidate::model()->done()->inTime()->doctor()->count();
//                $count['кандидатов наук, закончивших вовремя'] = Candidate::model()->done()->inTime()->notDoctor()->count();
//                $count['закончил невовремя'] = Candidate::model()->done()->notInTime()->count();
//                $count['не успел вовремя защититься'] = Candidate::model()->undone()->inTime()->count();
//                $count['ещё не защитился'] = Candidate::model()->undone()->notInTime()->count();
            }
        }

        $this->render('stat/stat', array(
            'model' => $formModel,
            'count' => null,
        ));
//        $count = array();
//
//        $this->renderText(CVarDumper::dumpAsString($count, 10, true));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Candidate::model()->findByPk($id);
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
