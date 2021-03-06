<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\Nav;

?>

<?= Nav::widget([
    'options' => [
        'class' => 'nav-tabs',
        'style' => 'margin-bottom: 15px',
    ],
    'items' => [
        [
            'label' => 'Замовлення',
            'url' => ['/user/admin/orders'],
        ],
        [
            'label' => 'Замовлення на користувача',
            'url' => ['/user/admin/user-orders'],
        ],        
        [
            'label' => 'Історія операцій',
            'url' => ['/user/admin/user-balance'],
        ],
        [
            'label' => 'Нерозподілені продукти',
            'url' => ['/user/admin/undefined-products'],
	],
	[
            'label' => 'Менеджер',
            'url' => ['/a-category/index'],
        ],
        [
            'label' => 'Користувачі',
            'url' => ['/user/admin/index'],
        ],
        [
            'label' => 'Сортувати по: ',
            'url' => ['/user/admin/sort'],
        ],
        [
            'label' => Yii::t('user', 'Ролі'),
            'url' => ['/rbac/role/index'],
            'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
        ],
        [
            'label' => Yii::t('user', 'Права доступу'),
            'url' => ['/rbac/permission/index'],
            'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
        ],
        [
            'label' => \Yii::t('user', 'Правила'),
            'url'   => ['/rbac/rule/index'],
            'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
        ],
        [
            'label' => Yii::t('user', 'Створити'),
            'items' => [
                [
                    'label' => Yii::t('user', 'Новий користувач'),
                    'url' => ['/user/admin/create'],
                    'visible' => false,
                ],
                [
                    'label' => Yii::t('user', 'Нова роль'),
                    'url' => ['/rbac/role/create'],
                    'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
                ],
                [
                    'label' => Yii::t('user', 'Нові права доступу'),
                    'url' => ['/rbac/permission/create'],
                    'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
                ],
                [
                    'label' => \Yii::t('user', 'Нове правило'),
                    'url'   => ['/rbac/rule/create'],
                    'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
                ]
            ],
            'visible' => false,
        ],
    ],
    ]) ?>
