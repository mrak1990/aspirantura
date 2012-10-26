<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyBootGridView
 *
 * @author mrak1990
 */
Yii::import('ext.bootstrap.widgets.BootMenu');

class MyBootMenu extends BootMenu
{

    /**
     * Checks whether a menu item is active.
     *
     * @param array $item the menu item to be checked
     * @param string $route the route of the current request
     *
     * @return boolean the result
     */
    protected function isItemActive($item, $route)
    {
        if (isset($item['url']) && is_array($item['url']))
        {
            $trimmed_item_url = trim($item['url'][0], '/');
            if (!strpos($trimmed_item_url, '/'))
                $trimmed_item_url = Yii::app()->controller->id . '/' . $trimmed_item_url;

            if (!strcasecmp($trimmed_item_url, $route))
            {
                if (count($item['url']) > 1)
                    foreach (array_splice($item['url'], 1) as $name => $value)
                        if (!isset($_GET[$name]) || $_GET[$name] != $value)
                            return false;

                return true;
            }
        }

        return false;
    }
}

?>
