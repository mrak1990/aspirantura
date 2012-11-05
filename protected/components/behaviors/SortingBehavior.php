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

    /**
     * @param array $include options to be added to sort options
     * @param array $exclude options to be excluded from sort options
     *
     * @return array
     */
    public function getSortOptions(array $include = array(), array $exclude = array())
    {
        $owner = $this->getOwner();

        $attributes = array_merge(
            $owner->model()->attributeNames(),
            $include
        );
        $attributes = array_diff(
            $attributes,
            $exclude
        );

        if (method_exists($owner, 'getResolvedSortOptions'))
            $resolvedAttributes = $owner->getResolvedSortOptions();
        else
            $resolvedAttributes = array();

        $options = array();
        foreach ($attributes as $attribute)
        {
            if (isset($resolvedAttributes[$attribute]))
                $options[$resolvedAttributes[$attribute]] = $owner->model()->getAttributeLabel($attribute);
            else
                $options[$attribute] = $owner->model()->getAttributeLabel($attribute);
        }

        return $options;
    }
}

?>
