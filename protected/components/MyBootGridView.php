<?php
/**
 * Description of MyBootGridView
 *
 * @author mrak1990
 */
Yii::import('ext.bootstrap.widgets.BootGridView');

class MyBootGridView extends BootGridView
{

    public $footer = array();

    public function renderTableFooter()
    {
        $items = $this->footer['items'];
        if ($items !== null)
        {
            if (is_array($items) && count($items) !== 0)
            {
                $itemsToShow = array();
                foreach ($items as $item)
                {
                    if (!isset($item['visible']) || isset($item['visible']) && $item['visible'] === true)
                        $itemsToShow[] = $item['value'];
                }

                echo '<tfoot>';
                echo '<tr><td colspan="' . count($this->columns) . '"';
                if (isset($this->footer['class']))
                    echo " class=\"{$this->footer['class']}\"";
                echo '>';
                if (isset($this->footer['prepend']))
                    echo $this->footer['prepend'];
                else
                    echo 'С отмеченными: ';
                echo implode((isset($this->footer['delimiter'])) ? $this->footer['delimiter'] : ', ', $itemsToShow);
                echo '</td></tr>';
                echo '</tfoot>';
            }
        }
        else
            parent::renderTableFooter();
    }
}

?>
