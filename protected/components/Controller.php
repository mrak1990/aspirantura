<?php
/**
 * Controller class file
 *
 * @author mrak1990 gmrak1990@gmail.com
 */

class Controller extends CController
{

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    /**
     * @var string title of current page
     */
    public $pageTitle;

    public function init()
    {
        if ($this->pageTitle === null || $this->pageTitle === '')
            $this->pageTitle = Yii::app()->name;
        else
            $this->pageTitle = Yii::app()->name . ' | ' . $this->pageTitle;
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array('checkAccess');
    }

    public function filterCheckAccess($filterChain)
    {
        $user = Yii::app()->user;
        $itemName = $this->id
            . mb_convert_case($this->action->id, MB_CASE_TITLE);

        if (Yii::app()->authManager->checkAccess($itemName, $user->id))
            $filterChain->run();
        else
            $user->loginRequired();
    }
}