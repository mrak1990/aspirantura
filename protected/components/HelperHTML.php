<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class HelperHTML
{

    public static function capitalize($str, $encoding = null)
    {
        $str = mb_strtoupper($str{0}, $encoding) . mb_substr($str, 1, mb_strlen($str, $encoding) - 1, $encoding);

        return $str;
    }

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
        $deletable = is_subclass_of($model, 'DeletableActiveRecord');

        $menu = array(
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
                    ? $deletable
                    : true,
                'icon' => 'trash',
                'itemOptions' => array(
                    'title' => 'Просмотр записей в корзине'
                )
            ),
        );

        if ($view === 'create')
            return $menu;
        elseif ($view === 'index')
        {
            return array_merge($menu, array(
                array(
                    'label' => 'Параметры',
                    'icon' => 'cog',
                    'itemOptions' => array(
                        'class' => 'pull-right',
                        'title' => 'Параметры вывода'
                    ),
                    'items' => array(),
                )
            ));
        }
        elseif ($view === 'update' || $view === 'view')
        {
            return array_merge($menu, array(
                array(
                    'label' => 'Действия',
                    'icon' => 'eye-open',
                    'itemOptions' => array(
                        'class' => 'pull-right',
                        'title' => 'Действия над записью'
                    ),
                    'items' => array(
//                        array(
//                            'url' => '',
//                            'template' => CHtml::ajaxLink('<i class="icon-trash"></i> В корзину — .ajax()', array('toTrash'), array(
//                                    'data' => new CJavaScriptExpression("{id : '{$model->id}'}"),
////                                    'success' => new CJavaScriptExpression('$("#label-deleted").show()'),
//                                    'update' => '#content-div',
//                                )
//                            ),
//                            'visible' => $deletable
//                                ? !$model->deleted
//                                : false,
//                        ),
//                        array(
//                            'url' => '',
//                            'template' => CHtml::ajaxLink('<i class="icon-trash"></i> Восстановить — .ajax()', array('restore'), array(
//                                    'data' => new CJavaScriptExpression("{id : '{$model->id}'}"),
////                                    'success' => new CJavaScriptExpression('$("#label-deleted").hide()'),
//                                    'update' => '#content-div',
//                                )
//                            ),
//                            'visible' => $deletable
//                                ? $model->deleted
//                                : false,
//                        ),
                        array(
                            'label' => 'В корзину',
                            'url' => '#',
                            'visible' => $deletable
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
                            'visible' => $deletable
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
                            'visible' => $deletable
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
            ));
        }
        else
            return array();
    }
}

?>
