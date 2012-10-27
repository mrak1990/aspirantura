<?php

/**
 * TrashBinBehaviour class file.
 *
 * @author mrak1990
 */

/**
 * TrashBinBehaviour allows you to remove the model in the trash bin and restore them when need.
 *
 * @author mrak1990
 */
class TrashBinBehavior extends CActiveRecordBehavior
{

    public $deletedFlagField = 'deleted';
    public $deletedFlag = true;
    public $restoredFlag = false;

    protected function bool2str($value)
    {
        return is_bool($value)
            ? ($value
                ? 'true'
                : 'false')
            : $value;
    }

    public function getDeletedRecords()
    {
        $this->getOwner()->getDbCriteria()->mergeWith(array(
            'condition' => "\"{$this->getOwner()->getTableAlias()}\".\"{$this->deletedFlagField}\"='{$this->bool2str($this->deletedFlag)}'",
        ));

        return $this->getOwner();
    }

    public function getRestoredRecords()
    {
        $this->getOwner()->getDbCriteria()->mergeWith(array(
            'condition' => "\"{$this->getOwner()->getTableAlias()}\".\"{$this->deletedFlagField}\"='{$this->bool2str($this->restoredFlag)}'",
        ));

        return $this->getOwner();
    }

    public function getDeleted()
    {
        return $this->getOwner()->{$this->deletedFlagField} === $this->deletedFlag;
    }

    public function setDeleted()
    {
        $owner = $this->getOwner();
        $owner->{$this->deletedFlagField} = $this->deletedFlag;

//        $owner->save();
        return $owner;
    }

    public function setRestored()
    {
        $owner = $this->getOwner();
        $owner->{$this->deletedFlagField} = $this->restoredFlag;

//        CVarDumper::dump($owner, 3, true);
//        $owner->save(); 
        return $owner;
    }
}

?>