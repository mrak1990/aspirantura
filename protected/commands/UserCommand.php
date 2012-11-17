<?php
class UserCommand extends CConsoleCommand
{
    /**
     * @var CAuthManager
     */
    private $_authManager;

    public $overwrite = false;

    public $defaultAuthItems = array(
        array(
            'name' => 'facultyControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                'facultyIndex',
                'facultyView',
                'facultyCreate',
                'facultyUpdate',
                'facultyDelete',
                'facultyTrash',
                'facultyToTrash',
                'facultyRestore',
            ),
        ),
        array(
            'name' => 'departmentControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                'departmentIndex',
                'departmentView',
                'departmentCreate',
                'departmentUpdate',
                'departmentDelete',
                'departmentTrash',
                'departmentToTrash',
                'departmentRestore',
            ),
        ),
        array(
            'name' => 'staffControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                'staffIndex',
                'staffView',
                'staffCreate',
                'staffUpdate',
                'staffDelete',
                'staffTrash',
                'staffToTrash',
                'staffRestore',
            ),
        ),
        array(
            'name' => 'candidateControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                'candidateIndex',
                'candidateView',
                'candidateCreate',
                'candidateUpdate',
                'candidateDelete',
                'candidateTrash',
                'candidateToTrash',
                'candidateRestore',
            ),
        ),
        array(
            'name' => 'scienceBranchControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                'scienceBranchIndex',
                'scienceBranchView',
                'scienceBranchCreate',
                'scienceBranchUpdate',
                'scienceBranchDelete',
                'scienceBranchTrash',
                'scienceBranchToTrash',
                'scienceBranchRestore',
            ),
        ),
        array(
            'name' => 'specialityControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                'specialityIndex',
                'specialityView',
                'specialityCreate',
                'specialityUpdate',
                'specialityDelete',
                'specialityTrash',
                'specialityToTrash',
                'specialityRestore',
            ),
        ),
        array(
            'name' => 'thesisBoardControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                'thesisBoardIndex',
                'thesisBoardView',
                'thesisBoardCreate',
                'thesisBoardUpdate',
                'thesisBoardDelete',
                'thesisBoardTrash',
                'thesisBoardToTrash',
                'thesisBoardRestore',
            ),
        ),
        array(
            'name' => 'userControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                'userIndex',
                'userView',
                'userCreate',
                'userUpdate',
                'userDelete',
                'userTrash',
                'userToTrash',
                'userRestore',
            ),
        ),
        array(
            'name' => 'authItemControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                'authItemIndex',
                'authItemView',
                'authItemCreate',
                'authItemUpdate',
                'authItemDelete',
                'authItemTrash',
                'authItemToTrash',
                'authItemRestore',
            ),
        ),
    );

    public function actionInitialize()
    {
        echo "Start default auth items initialization\n";

        foreach ($this->defaultAuthItems as $authItem)
        {
            $this->createRecursive($authItem);
        }
        echo "End default items initialization\n";
    }

    public function init()
    {
        $this->_authManager = Yii::app()->authManager;
    }

    protected function createRecursive($authItem, $parentAuthItem = null)
    {
        if (is_array($authItem))
        {
            if (isset($authItem['name']))
            {
                $type = isset($authItem['type'])
                    ? $authItem['type']
                    : CAuthItem::TYPE_OPERATION;
                $addedFlag = false;

                if ($this->_authManager->getAuthItem($authItem['name']) === null)
                {
                    $this->_authManager->createAuthItem($authItem['name'], $type);
                    $addedFlag = true;

                    if ($parentAuthItem !== null)
                        $this->_authManager->addItemChild($parentAuthItem, $authItem['name']);
                }
                else
                {
                    if ($this->overwrite)
                    {
                        echo "'{$authItem['name']}' was overwritten\n";

                        $this->_authManager->removeAuthItem($authItem['name']);
                        $this->_authManager->createAuthItem($authItem['name'], $type);
                        $addedFlag = true;

                        if ($parentAuthItem !== null)
                            $this->_authManager->addItemChild($parentAuthItem, $authItem['name']);
                    }
                }

                if ($addedFlag === true && isset($authItem['subItems']) && is_array($authItem['subItems']))
                {
                    foreach ($authItem['subItems'] as $subAuthItem)
                        $this->createRecursive($subAuthItem, $authItem['name']);
                }
            }
        }
        else
        {
            if ($this->_authManager->getAuthItem($authItem) === null)
                $this->_authManager->createAuthItem($authItem, CAuthItem::TYPE_OPERATION);
            else
            {
                if ($this->overwrite)
                {
                    echo "'{$authItem}' was overwritten\n";
                    $this->_authManager->removeAuthItem($authItem);
                    $this->_authManager->createAuthItem($authItem, CAuthItem::TYPE_OPERATION);
                }
            }
        }
    }
}

?>