<?php
class GoCommand extends CConsoleCommand
{
    public function run($args)
    {
        echo 'Hello, world';
        echo Yii::app()->createAbsoluteUrl('faculty/view');
    }
}

?>