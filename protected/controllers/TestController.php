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

    public function action1()
    {
//        $result = Yii::app()->db->createCommand()
//                ->select('title')
//                ->from('department')
//                ->queryColumn();

        $cs = Yii::app()->clientScript;
        $cs->registerScript('test1', "
            $('#example1').ajaxChosen(
                {
                    method: 'GET',
                    url: '/ajax-chosen/data.php',
                    dataType: 'json'
                },
                function (data) {
                    var terms = {};

                    $.each(data, function (i, val) {
                        terms[i] = val;
                    });

                    return terms;
                }
            );            
        ", CClientScript::POS_READY);

        echo '1111';
//        CVarDumper::dump($result, 10, true);
//        Yii::app()->end();
    }
}

?>
