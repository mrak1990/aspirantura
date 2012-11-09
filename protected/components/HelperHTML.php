<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class HelperHTML
{

    /**
     * @param $data
     * @param $count
     * @param $route
     * @param string $name
     *
     * @return string
     */
    public static function spoiler($data, $count, $route, $name = 'id')
    {
        $list_tmp = array_map(function ($item) use ($name, $route)
        {
            return CHtml::link($item, array($route, $name => $item));
        }, $data);
        if (count($list_tmp) > $count)
        {
            $activeList = array_slice($list_tmp, 0, $count);
            $hiddenList = array_slice($list_tmp, $count);

            return implode(', ', $activeList)
                . ', <a class="expander" href="#">(+' . count($list_tmp) - $count . ')</a>'
                . '<span class="spoiler collapsed">' . implode(', ', $hiddenList) . ' <a class="collapser" href="#">(свернуть)</a></span>';
        }
        else
            return implode(', ', $list_tmp);
    }

    public static function getMenu($view = 'index', $model = null)
    {
        if ($view === 'index')
        {
            return array(
                array(
                    'label' => 'Поиск',
                    'url' => array('index'),
                    'icon' => 'search',
                    'itemOptions' => array(
                        'title' => 'Поиск и фильтрация записей'
                    )
                ),
                array(
                    'label' => 'Добавить',
                    'url' => array('create'),
                    'icon' => 'plus',
                    'itemOptions' => array(
                        'title' => 'Добавление новой записи'
                    )
                ),
                array(
                    'label' => 'Корзина',
                    'url' => array('trash'),
                    'visible' => isset($model)
                        ? $model::DELETABLE
                        : true,
                    'icon' => 'trash',
                    'itemOptions' => array(
                        'title' => 'Просмотр записей в корзине'
                    )
                ),
                array(
                    'label' => 'Параметры',
                    'icon' => 'cog',
                    'itemOptions' => array(
                        'class' => 'pull-right',
                        'title' => 'Параметры вывода'
                    ),
                    'items' => array(),
                )
            );
        }
        elseif ($view === 'create')
        {
            return array(
                array(
                    'label' => 'Поиск',
                    'url' => array('index'),
                    'icon' => 'search',
                    'itemOptions' => array(
                        'title' => 'Поиск и фильтрация записей'
                    )
                ),
                array(
                    'label' => 'Добавить',
                    'url' => array('create'),
                    'icon' => 'plus',
                    'itemOptions' => array(
                        'title' => 'Добавление новой записи'
                    )
                ),
                array(
                    'label' => 'Корзина',
                    'url' => array('trash'),
                    'visible' => $model::DELETABLE,
                    'icon' => 'trash',
                    'itemOptions' => array(
                        'title' => 'Просмотр записей в корзине'
                    )
                ),
            );
        }
        elseif ($view === 'update')
        {
            return array(
                array
                ('label' => 'Поиск',
                    'url' => array('index'),
                    'icon' => 'search',
                    'itemOptions' => array(
                        'title' => 'Поиск и фильтрация записей'
                    )
                ),
                array(
                    'label' => 'Добавить',
                    'url' => array('create'),
                    'icon' => 'plus',
                    'itemOptions' => array(
                        'title' => 'Добавление новой записи'
                    )
                ),
                array(
                    'label' => 'Корзина',
                    'url' => array('trash'),
                    'visible' => $model::DELETABLE,
                    'icon' => 'trash',
                    'itemOptions' => array(
                        'title' => 'Просмотр записей в корзине'
                    )
                ),
                array(
                    'label' => 'Действия',
                    'icon' => 'cog',
                    'itemOptions' => array(
                        'class' => 'pull-right',
                        'title' => 'Действия над записью'
                    ),
                    'items' => array(
                        array(
                            'label' => 'В корзину',
                            'url' => '#',
                            'visible' => $model::DELETABLE
                                ? !$model->deleted
                                : false,
                            'icon' => 'trash',
                            'linkOptions' => array(
                                'submit' => array(
                                    'toTrash',
                                    'id' => $model->id
                                ),
                                'params' => array(
                                    'ajax' => true,
                                )
                            ),
                        ),
                        array(
                            'label' => 'Восстановить',
                            'url' => '#',
                            'visible' => $model::DELETABLE
                                ? $model->deleted
                                : false,
                            'icon' => 'ok-circle',
                            'linkOptions' => array(
                                'submit' => array(
                                    'restore',
                                    'id' => $model->id
                                ),
                                'params' => array(
                                    'ajax' => true,
                                )
                            ),
                        ),

                        array(
                            'label' => 'Удалить',
                            'url' => '#',
                            'visible' => $model::DELETABLE
                                ? $model->deleted
                                : false,
                            'icon' => 'remove',
                            'linkOptions' => array(
                                'submit' => array(
                                    'delete',
                                    'id' => $model->id
                                ),
                                'confirm' => 'Вы действительно хотите безвозвратно удалить эту запись?',
                            ),
                        ),
                    ),
                ),
                array(
                    'label' => 'Редактирование',
                    'url' => array(
                        'update',
                        'id' => $model->id
                    ),
                    'icon' => 'pencil',
                    'itemOptions' => array(
                        'class' => 'pull-right',
                        'title' => 'Редактирование записи'
                    )
                ),

                array(
                    'label' => 'Просмотр',
                    'url' => array(
                        'view',
                        'id' => $model->id
                    ),
                    'icon' => 'th-list',
                    'itemOptions' => array(
                        'class' => 'pull-right',
                        'title' => 'Простотр записи'
                    )
                ),
            );
        }
        elseif ($view === 'view')
        {
            return array(
                array(
                    'label' => 'Поиск',
                    'url' => array('index'),
                    'icon' => 'search',
                    'itemOptions' => array(
                        'title' => 'Поиск и фильтрация записей'
                    )
                ),
                array(
                    'label' => 'Добавить',
                    'url' => array('create'),
                    'icon' => 'plus',
                    'itemOptions' => array(
                        'title' => 'Добавление новой записи'
                    ),
                ),
                array(
                    'label' => 'Корзина',
                    'url' => array('trash'),
                    'visible' => $model::DELETABLE,
                    'icon' => 'trash',
                    'itemOptions' => array(
                        'title' => 'Просмотр записей в корзине'
                    )
                ),
                array(
                    'label' => 'Действия',
                    'icon' => 'cog',
                    'itemOptions' => array(
                        'class' => 'pull-right',
                        'title' => 'Действия над записью'
                    ),
                    'items' => array(
                        array(
                            'label' => 'В корзину',
                            'url' => '#',
                            'visible' => $model::DELETABLE
                                ? !$model->deleted
                                : false,
                            'icon' => 'trash',
                            'linkOptions' => array(
                                'submit' => array(
                                    'toTrash',
                                    'id' => $model->id
                                ),
                                'params' => array(
                                    'ajax' => true,
                                )
                            ),
                        ),
                        array(
                            'label' => 'Восстановить',
                            'url' => '#',
                            'visible' => $model::DELETABLE
                                ? $model->deleted
                                : false,
                            'icon' => 'ok-circle',
                            'linkOptions' => array(
                                'submit' => array(
                                    'restore',
                                    'id' => $model->id
                                ),
                                'params' => array(
                                    'ajax' => true,
                                )
                            ),
                        ),
                        array(
                            'label' => 'Удалить',
                            'url' => '#',
                            'visible' => $model::DELETABLE
                                ? $model->deleted
                                : false,
                            'icon' => 'remove',
                            'linkOptions' => array(
                                'submit' => array(
                                    'delete',
                                    'id' => $model->id
                                ),
                                'confirm' => 'Вы действительно хотите безвозвратно удалить эту запись?',
                            ),
                        ),
                    ),
                ),
                array(
                    'label' => 'Редактирование',
                    'url' => array(
                        'update',
                        'id' => $model->id
                    ),
                    'icon' => 'pencil',
                    'itemOptions' => array(
                        'class' => 'pull-right',
                        'title' => 'Редактирование записи'
                    )
                ),
                array(
                    'label' => 'Просмотр',
                    'url' => array(
                        'view',
                        'id' => $model->id
                    ),
                    'icon' => 'th-list',
                    'itemOptions' => array(
                        'class' => 'pull-right',
                        'title' => 'Простотр записи'
                    )
                ),
            );
        }
        else
            return array();
    }
}

?>
