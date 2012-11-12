<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestController
 *
 * @author mrak1990
 */
class TestController extends Controller
{

    public function actionIndex()
    {
        $model = new Candidate;
        $modelCriteria = $model->getDbCriteria();
        $modelCriteria->scopes = array('undone');
        $criteria = new CDbCriteria(array(
            'scopes' => array('done')
        ));
        $sort = new CSort('Candidate');
//        $modelCriteria->mergeWith($criteria);
        $provider = new CActiveDataProvider($model, array(
            'criteria' => $criteria,
            'sort' => $sort,
        ));

        $provider->getData();

        CVarDumper::dump($provider->getCriteria(), 10, true);
//        CVarDumper::dump($provider->getData(), 10, true);

//        $this->widget('MyBootGridView', array(
//            'type' => 'striped bordered condensed',
//            'dataProvider' => new CActiveDataProvider($model, array(
//                'criteria' => $criteria,
//
//            )),
//            'columns' => array(//                'id',
//            )
//        ));
    }
}

?>
