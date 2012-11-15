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
    public static function spoiler($data, $count, $route, $name = null)
    {
        $list_tmp = array_map(function ($item) use ($name, $route)
        {
            return $name === null
                ? CHtml::link($item, array($route, 'name' => $item))
                : CHtml::link($item['label'], array($route, $name => $item['id']));
        }, $data);

        if (count($list_tmp) > $count)
        {
            $activeList = array_slice($list_tmp, 0, $count);
            $hiddenList = array_slice($list_tmp, $count);

            return implode(', ', $activeList)
                . ', <a class="expander" href="#">(+' . (count($list_tmp) - $count) . ')</a>'
                . '<span class="spoiler collapsed">' . implode(', ', $hiddenList) . ' <a class="collapser" href="#">(свернуть)</a></span>';
        }
        else
            return implode(', ', $list_tmp);
    }

    public static function getMenu($view = 'index', $model = null, $idField = 'id')
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
                                    $idField => $model->{$idField}
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
                                    $idField => $model->{$idField}
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
                                : true,
                            'icon' => 'remove',
                            'linkOptions' => array(
                                'submit' => array(
                                    'delete',
                                    $idField => $model->{$idField}
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
                        $idField => $model->{$idField}
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
                        $idField => $model->{$idField}
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
                                    $idField => $model->{$idField}
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
                                    $idField => $model->{$idField}
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
                                : true,
                            'icon' => 'remove',
                            'linkOptions' => array(
                                'submit' => array(
                                    'delete',
                                    $idField => $model->{$idField}
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
                        $idField => $model->{$idField}
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
                        $idField => $model->{$idField}
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
