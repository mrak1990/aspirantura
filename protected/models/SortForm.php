<?php
/**
 * SortForm class.
 * SortForm is the data structure for keeping sort parameters.
 */

class SortForm extends CFormModel
{
    /**
     * @var string sot parameters in GET
     */
    public $sort = '';
    /**
     * @var string direction of sort
     */
    public $direction = 'asc';

    public function rules()
    {
        return array(
            array('sort, direction', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'faculty_id' => 'Факультет',
            'department_id' => 'Кафедра',
            'sort' => 'Сортировать по',
            'direction' => 'Порядок',
        );
    }

    /**
     * Formate GET[sort] for using in CSort
     */
    public function resolveGETSort()
    {
        if ($this->sort !== null)
        {
            if (isset($this->direction) && $this->direction === 'desc')
                $_GET['sort'] = "{$this->sort}.{$this->direction}";
            else
                $_GET['sort'] = $this->sort;
        }
    }
}
