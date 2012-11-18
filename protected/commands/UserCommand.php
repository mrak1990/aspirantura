<?php
class UserCommand extends CConsoleCommand
{
    /**
     * @var CAuthManager
     */
    private $_authManager;

    public $overwriteAuthItems = false;
    public $overwriteAdminUser = false;

    public $defaultAuthItems = array(
        'Гость' => array(
            'type' => CAuthItem::TYPE_ROLE,
            'bizRule' => 'return Yii::app()->user->isGuest;'
        ),
        'Авторизированный' => array(
            'type' => CAuthItem::TYPE_ROLE,
            'bizRule' => 'return !Yii::app()->user->isGuest;'
        ),
        'Администраторы' => array(
            'type' => CAuthItem::TYPE_ROLE,
            'subItems' => array(
                'facultyControl' => array(
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
                'departmentControl' => array(
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
                        'departmentOptionList',
                    ),
                ),
                'staffControl' => array(
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
                        'staffSearch'
                    ),
                ),
                'candidateControl' => array(
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
                'scienceBranchControl' => array(
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
                'specialityControl' => array(
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
                'thesisBoardControl' => array(
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
                'userControl' => array(
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
                'authItemControl' => array(
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
            )
        ),
    );

    public function init()
    {
        $this->_authManager = Yii::app()->authManager;
    }

    public function actionInitialize()
    {
        echo "Start default auth items initialization\n";
        $this->createRecursive($this->defaultAuthItems);
        echo "End default auth items initialization\n";
        if (($id = $this->createAdminUser()) !== false)
        {
            echo "Admin user id: {$id}\n";
            $this->assignAdminUser($id);
            echo "Admin user was assigned to admins\n";
        }
        else
            echo "Admin user wasn't assigned to admins\n";
    }

    /**
     * Creates an CAuthItems from configuration array and set child relation between them
     *
     * @param array $items array('item1', 'item2'=>array('subItems' => array(...)))
     * @param string $parentName the name of parent CAuthItem
     */
    private
    function createRecursive(array $items, $parentName = null)
    {
        $itemsProcessed = $this->processItems($items);

        foreach ($itemsProcessed as $name => $options)
        {
            $type = isset($options['type'])
                ? $options['type']
                : CAuthItem::TYPE_OPERATION;
            $description = isset($options['description'])
                ? $options['description']
                : '';
            $bizRule = isset($options['bizRule'])
                ? $options['bizRule']
                : null;

            if ($this->createItem($name, $type, $description, $bizRule))
            {
                if ($parentName !== null)
                    $this->_authManager->addItemChild($parentName, $name);

                if (isset($options['subItems']) && is_array($options['subItems']))
                    $this->createRecursive($options['subItems'], $name);
            }
        }
    }

    /**
     * Creates an authorization item
     *
     * @param string $name the name of CAuthItem
     * @param integer $type the type of CAuthItem
     *
     * @return bool
     */
    private
    function createItem($name, $type, $description = '', $bizRule = null)
    {
        if ($this->_authManager->getAuthItem($name) === null)
        {
            $this->_authManager->createAuthItem($name, $type, $description, $bizRule);

            return true;
        }
        else
        {
            if ($this->overwriteAuthItems)
            {
                echo "'{$name}' was overwritten\n";

                $this->_authManager->removeAuthItem($name);
                $this->_authManager->createAuthItem($name, $type, $description, $bizRule);

                return true;
            }
        }

        return false;
    }

    /**
     * Process array of items
     *
     * @param array $items array('item1', 'item2'=>array(...))
     *
     * @return array array('item1' => array(), 'item2'=>array(...))
     */
    private
    function processItems(array $items)
    {
        $tmpArray = array();
        foreach ($items as $key => $value)
        {
            if (is_array($value))
                $tmpArray[$key] = $value;
            else
                $tmpArray[$value] = array();
        }

        return $tmpArray;
    }

    private
    function createAdminUser()
    {
        $model = User::model()->findByAttributes(array('username' => 'admin'));
        if ($model !== null)
        {
            if ($this->overwriteAdminUser && $model->delete())
                echo "Old admin user was deleted\n";
            else
            {
                echo "Admin user wasn't overwritten\n";

                return $model->id;
            }
        }

        $model = new User();

        $model->attributes = array(
            'username' => 'admin',
            'password' => 'admin',
            'password2' => 'admin',
            'first_name' => 'Администратор',
            'last_name' => 'Администраторов',
            'email' => 'admin@qwerty.ru'
        );
        if ($model->save())
        {
            echo "Admin user was created\n";

            return $model->id;
        }
        else
        {
            echo "Admin user wasn't created\n";

            return false;
        }
    }

    private
    function assignAdminUser($id)
    {
        return $this->_authManager->assign('Администраторы', $id);
    }
}

?>