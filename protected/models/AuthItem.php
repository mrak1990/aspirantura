<?php

/**
 * This is the model class for table "AuthItem".
 *
 * The followings are the available columns in table 'AuthItem':
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $childrenRoles
 * @property string $childrenTasks
 * @property string $childrenOperations
 * @property string $authItem
 *
 * The followings are the available model relations:
 * @property AuthAssignment[] $authAssignments
 * @property AuthItemChild[] $children
 * @property AuthItemChild[] $parents
 */
class AuthItem extends CActiveRecord
{

    private $_authItem;
    public $children = array(
        'operations' => array(),
        'tasks' => array(),
        'roles' => array(),
    );
    public $parents = array(
        'operations' => array(),
        'tasks' => array(),
        'roles' => array(),
    );

    //TODO: make static attribute
    private $_emptyPostData = array(
        'children' => array(
            'operations' => array(),
            'tasks' => array(),
            'roles' => array(),
        ),
        'parents' => array(
            'operations' => array(),
            'tasks' => array(),
            'roles' => array(),
        ),
        'users' => array(),
    );
//    public $childrenTasks = array();
//    public $childrenRoles = array();
//    public $parentsOperations = array();
//    public $parentsTasks = array();
//    public $parentsRoles = array();
    static public $types = array('Операция', 'Задача', 'Роль');
    public $users = array();

    public function getLongType()
    {
        return AuthItem::$types[$this->type];
    }

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return AuthItem the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'AuthItem';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
//            array('description, roles, tasks, operations', 'safe'),
            array('children, parents, users', 'safe'),
            array('name, type, description', 'default', 'value' => null),
            array('type', 'in', 'range' => array('0', '1', '2'), 'allowEmpty' => false),
            array('name', 'required'),
            array('name', 'length', 'max' => 64),
            // The following rule is used by search().
// Please remove those attributes that should not be searched.
            array('name, type, description', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
//    public function relations()
//    {
//        // NOTE: you may need to adjust the relation name and the related
//        // class name for the relations automatically generated below.
//        return array(
//            'authAssignments' => array(self::HAS_MANY, 'AuthAssignment', 'itemname'),
////            'parents' => array(self::HAS_MANY, 'AuthItemChild', 'child'),
//        );
//    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'name' => 'Название',
            'type' => 'Тип',
            'description' => 'Описание',
            'children[operations]' => 'Операции',
            'children[tasks]' => 'Задачи',
            'children[roles]' => 'Роли',
            'parents[operations]' => 'Операции',
            'parents[tasks]' => 'Задачи',
            'parents[roles]' => 'Роли',
            'users' => 'Пользователи',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
// Warning: Please modify the following code to remove attributes that
// should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('bizrule', $this->bizrule, true);
        $criteria->compare('data', $this->data, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function mergeChild()
    {
        $children = array();

//        CVarDumper::dump($this->children, 1, true);
//        Yii::app()->end();

        foreach ($this->children['operations'] as $item)
            $children[] = $item;
        if ($this->type >= 1) {
            foreach ($this->children['tasks'] as $item)
                $children[] = $item;
        }
        if ($this->type === 2) {
            foreach ($this->children['roles'] as $item)
                $children[] = $item;
        }

        return $children;
    }

    public function mergeParents()
    {
        $parents = array();

        foreach ($this->parents['roles'] as $item)
            $parents[] = $item;
        if ($this->type <= 1) {
            foreach ($this->parents['tasks'] as $item)
                $parents[] = $item;
        }
        if ($this->type === 0) {
            foreach ($this->parents['operations'] as $item)
                $parents[] = $item;
        }

        return $parents;
    }

    protected function afterFind()
    {
        foreach (Yii::app()->authManager->getItemChildren($this->name) as $item) {
            if ($item->type === 0)
                $this->children['operations'][] = $item->name;
            elseif ($item->type === 1)
                $this->children['tasks'][] = $item->name; elseif ($item->type === 2)
                $this->children['roles'][] = $item->name;
        }

        foreach (Yii::app()->authManager->getItemParents($this->name) as $item) {
            if ($item->type === 0)
                $this->parents['operations'][] = $item->name;
            elseif ($item->type === 1)
                $this->parents['tasks'][] = $item->name; elseif ($item->type === 2)
                $this->parents['roles'][] = $item->name;
        }

        $this->users = array_map(function ($value) {
            return $value->userid;
        }, Yii::app()->authManager->getAuthAssignmentsByItemName($this->name));

        parent::afterFind();
    }

    public static function getAll($authItem = null)
    {
        $query = Yii::app()->db->createCommand()
            ->select('name, type')
            ->from('AuthItem');

        if ($authItem !== null)
            $query = $query->where('name!=:name1', array('name1' => $authItem));

        $authItems = array('operations' => array(), 'tasks' => array(), 'roles' => array());
        foreach ($query->queryAll() as $item) {
            if ($item['type'] === 2)
                $authItems['roles'][$item['name']] = $item['name'];
            elseif ($item['type'] === 1)
                $authItems['tasks'][$item['name']] = $item['name']; elseif ($item['type'] === 0)
                $authItems['operations'][$item['name']] = $item['name'];
        }

        return $authItems;
    }

    public function updateChildrenAndParents()
    {
        $childrenOld = array_map(function ($item) {
            return $item->name;
        }, Yii::app()->authManager->getItemChildren($this->name));
        $parentsOld = array_map(function ($item) {
            return $item->name;
        }, Yii::app()->authManager->getItemParents($this->name));

        $childrenNew = $this->mergeChild();
        $parentsNew = $this->mergeParents();

        $auth = Yii::app()->authManager;
        foreach (array_diff($childrenOld, $childrenNew) as $item)
            $auth->removeItemChild($this->name, $item);
        foreach (array_diff($parentsOld, $parentsNew) as $item)
            $auth->removeItemChild($item, $this->name);
        foreach (array_diff($childrenNew, $childrenOld) as $item)
            $auth->addItemChild($this->name, $item);
        foreach (array_diff($parentsNew, $parentsOld) as $item)
            $auth->addItemChild($item, $this->name);
    }

    public function updateUsers()
    {
        $usersOld = array_map(function ($value) {
            return $value->userid;
        }, Yii::app()->authManager->getAuthAssignmentsByItemName($this->name));

        $authItem = Yii::app()->authManager->getAuthItem($this->name);
        foreach (array_diff($usersOld, $this->users) as $item)
            $authItem->revoke($item);
        foreach (array_diff($this->users, $usersOld) as $item)
            $authItem->assign($item);
    }

    public function setAuthItem($value)
    {
        $this->_authItem = $value;
    }

    public function getAuthItem()
    {
        return $this->_authItem;
    }

    public function getEmptyPostData()
    {
        return $this->_emptyPostData;
    }
}