<?php

/**
 * SearchForm class.
 * SearchForm is the data structure for keeping search parameters.
 */
class SearchForm extends CFormModel
{
    /**
     * @var string
     */
    public $sort = '';
    /**
     * @var string
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

    public function resolveGETSort()
    {
        if ($this->sort !== null) {
            if (isset($this->direction) && $this->direction === 'desc')
                $_GET['sort'] = "{$this->sort}.{$this->direction}";
            else
                $_GET['sort'] = $this->sort;
        }
    }
}
