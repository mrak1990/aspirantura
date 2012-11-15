<?php
class UserCommand extends CConsoleCommand
{
    public $defaultAuthItems = array(
        array(
            'name' => 'facultyControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                array(
                    'name' => 'facultyIndex',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'facultyView',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'facultyCreate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'facultyUpdate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'facultyDelete',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'facultyTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'facultyToTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'facultyRestore',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
            ),
        ),
        array(
            'name' => 'departmentControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                array(
                    'name' => 'departmentIndex',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'departmentView',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'departmentCreate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'departmentUpdate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'departmentDelete',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'departmentTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'departmentToTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'departmentRestore',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
            ),
        ),
        array(
            'name' => 'staffControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                array(
                    'name' => 'staffIndex',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'staffView',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'staffCreate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'staffUpdate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'staffDelete',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'staffTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'staffToTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'staffRestore',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
            ),
        ),
        array(
            'name' => 'candidateControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                array(
                    'name' => 'candidateIndex',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'candidateView',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'candidateCreate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'candidateUpdate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'candidateDelete',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'candidateTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'candidateToTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'candidateRestore',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
            ),
        ),
        array(
            'name' => 'scienceBranchControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                array(
                    'name' => 'scienceBranchIndex',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'scienceBranchView',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'scienceBranchCreate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'scienceBranchUpdate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'scienceBranchDelete',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'scienceBranchTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'scienceBranchToTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'scienceBranchRestore',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
            ),
        ),
        array(
            'name' => 'specialityControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                array(
                    'name' => 'specialityIndex',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'specialityView',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'specialityCreate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'specialityUpdate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'specialityDelete',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'specialityTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'specialityToTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'specialityRestore',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
            ),
        ),
        array(
            'name' => 'thesisBoardControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                array(
                    'name' => 'thesisBoardIndex',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'thesisBoardView',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'thesisBoardCreate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'thesisBoardUpdate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'thesisBoardDelete',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'thesisBoardTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'thesisBoardToTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'thesisBoardRestore',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
            ),
        ),
        array(
            'name' => 'userControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                array(
                    'name' => 'userIndex',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'userView',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'userCreate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'userUpdate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'userDelete',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'userTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'userToTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'userRestore',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
            ),
        ),
        array(
            'name' => 'authItemControl',
            'type' => CAuthItem::TYPE_TASK,
            'subItems' => array(
                array(
                    'name' => 'authItemIndex',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'authItemView',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'authItemCreate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'authItemUpdate',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'authItemDelete',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'authItemTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'authItemToTrash',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
                array(
                    'name' => 'authItemRestore',
                    'type' => CAuthItem::TYPE_OPERATION
                ),
            ),
        ),
    );

    public function actionInitialize()
    {
        echo "Start default user initialization\n";

        $auth = Yii::app()->authManager;

        foreach ($this->defaultAuthItems as $data)
        {
            if ($auth->getAuthItem($data['name']) === null)
                $auth->createAuthItem($data['name'], $data['type']);

            foreach ($data['subItems'] as $subData)
            {
                if ($auth->getAuthItem($subData['name']) === null)
                    $auth->createAuthItem($subData['name'], $subData['type']);
                if (!$auth->hasItemChild($data['name'], $subData['name']))
                    $auth->addItemChild($data['name'], $subData['name']);
            }
        }
        echo "End default user initialization\n";
    }
}

?>