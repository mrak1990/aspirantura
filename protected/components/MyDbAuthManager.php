<?php

/**
 * MyDbAuthManager class file.
 *
 * @author mrak1990 <gmrak1990@gmail.com>
 * @copyright Copyright &copy; 2012 Mark Kochanov
 */
class MyDbAuthManager extends CDbAuthManager
{

    public $userTable;

    /**
     * Returns the users assignments for the specified auth item.
     *
     * @param mixed $name the auth item name (see {@link CAuthItem::getName})
     *
     * @return array the user assignment information for the auth item. An empty array will be
     * returned if there is no item assigned to the auth item.
     */
    public function getAuthAssignmentsByItemName($name)
    {
        $rows = $this->db->createCommand()
            ->select()
            ->from(array($this->assignmentTable, $this->userTable))
            ->where('itemname=:itemname', array(':itemname' => $name))
            ->queryAll();

        $assignments = array();
        foreach ($rows as $row)
        {
            if (($data = @unserialize($row['data'])) === false)
                $data = null;

            $assignments[$row['userid']] = new CAuthAssignment($this, $row['itemname'], $row['userid'], $row['bizrule'], $data);
        }
        return $assignments;
    }

    public function getItemParents($names)
    {
        if (is_string($names))
            $condition = 'child=' . $this->db->quoteValue($names);
        else if (is_array($names) && $names !== array())
        {
            foreach ($names as &$name)
                $name = $this->db->quoteValue($name);
            $condition = 'child IN (' . implode(', ', $names) . ')';
        }

        $rows = $this->db->createCommand()
            ->select('name, type, description, bizrule, data')
            ->from(array(
            $this->itemTable,
            $this->itemChildTable
        ))
            ->where($condition . ' AND name=parent')
            ->queryAll();

        $parents = array();
        foreach ($rows as $row)
        {
            if (($data = @unserialize($row['data'])) === false)
                $data = null;
            $parents[$row['name']] = new CAuthItem($this, $row['name'], $row['type'], $row['description'], $row['bizrule'], $data);
        }
        return $parents;
    }
}
