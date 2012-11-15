<?php
class accessFilter extends CFilter
{
    protected function preFilter($filterChain)
    {
        Yii::log('OKKKKK');
        return false;
        return true; // false — для случая, когда действие не должно быть выполнено
    }
}

?>