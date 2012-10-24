<?php

/**
 * EChosen class file.
 *
 * @author Andrius Marcinkevicius <andrew.web@ifdattic.com>
 * @copyright Copyright &copy; 2011 Andrius Marcinkevicius
 * @license Licensed under MIT license. http://ifdattic.com/MIT-license.txt
 * @version 1.5.1
 */

/**
 * EChosen makes select boxes much more user-friendly.
 *
 * @author Andrius Marcinkevicius <andrew.web@ifdattic.com>
 */
class ChosenAjaxAddition extends CWidget
{

    /**
     * @var int widget creation count.
     */
    public static $count = 1;

    /**
     * @var string apply chosen plugin to these elements.
     */
    public $target = '';

    /**
     * @var array $.ajax options or plugin.
     */
    public $ajaxOptions = array(
        'dataType' => 'json',
        'type' => 'GET',
    );

    /**
     * @var array plugin options.
     */
    public $ajaxChosenOptions = array();

    /**
     * @var array native Chosen plugin options.
     */
    public $chosenOptions = array();

    /**
     * @var int script registration position.
     */
    public $scriptPosition = CClientScript::POS_END;

    /**
     * Apply Chosen plugin to select boxes.
     */
    public function run()
    {
        $count = self::$count++;

        // Publish extension assets
        $assets = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias(
            'ext.ChosenAjaxAddition') . '/assets');

        // Register extension assets
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($assets . '/chosen.css');

        // Register jQuery scripts
        $cs->registerScriptFile($assets . '/chosen.jquery-0.9.8.js', $this->scriptPosition);
        $cs->registerScriptFile($assets . '/chosen.ajaxaddition.jquery.js', $this->scriptPosition);

        $ajaxOptions = CJavaScript::encode($this->ajaxOptions);
//        if ($ajaxOptions === '[]')
//            $ajaxOptions = '{}';
        $ajaxChosenOptions = CMap::mergeArray($this->ajaxChosenOptions, array(
            'loadingImg' => $assets . '/loading.gif',
        ));
        $ajaxChosenOptions = CJavaScript::encode($ajaxChosenOptions);
//        if ($ajaxChosenOptions === '[]')
//            $ajaxChosenOptions = '{}';
        $chosenOptions = CJavaScript::encode($this->chosenOptions);
//        if ($chosenOptions === '[]')
//            $chosenOptions = '{}';

        $cs->registerScript("chosenAjaxAddition_{$count}", "$( '{$this->target}' ).ajaxChosen(
            {$ajaxOptions},
            {$ajaxChosenOptions},
            {$chosenOptions}
        );", CClientScript::POS_READY);
    }
}

?>