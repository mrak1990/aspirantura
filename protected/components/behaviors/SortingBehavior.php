<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SortingBehavior
 *
 * @author mrak1990
 */
class SortingBehavior extends CActiveRecordBehavior
{

    public function getSortAttributes(array $include = array(), array $exclude = array())
    {
        $owner = $this->getOwner();
        $attributes = array_merge($owner->model()->attributeNames(), $include);
        $attributes = array_diff($attributes, $exclude);
        $resolvedAttributes = $owner->resolveSortAttributes();

        $list = array();
        foreach ($attributes as $attribute) {
            if (isset($resolvedAttributes[$attribute]))
                $list[$resolvedAttributes[$attribute]] = $owner->model()->getAttributeLabel($attribute);
            else
                $list[$attribute] = $owner->model()->getAttributeLabel($attribute);
        }

        return $list;
    }
}

?>
