{% set appEnvironment = ['<span class="label label-danger">', app.params['environment'], '</span>']|join('') %}
{% set brandLabel = [
'
<div>
    <div style="position:absolute;">',
        app.params['environment'] != 'prod'?appEnvironment:'',
        '
    </div>
    ',
    html.img('/images/is-small.png'),
    '
</div>'
]|join('') %}

{{ nav_bar_begin({
'brandLabel': brandLabel,
'options' : {
'class': 'navbar navbar-default navbar-fixed-top'
},
'brandOptions': {
'style': 'padding-top: 0;'
}
}) }}
{% if app.user().isGuest() %}
{{ nav_widget({
'encodeLabels': false,
'options' : {
'class': 'navbar-nav navbar-left',
},
'items': [
{'label': '<i class="fa fa-image"></i> Фотоальбомы', 'url': '/album'},
{'label': 'Родителям', 'items': [
{
'label': '<i class="fa fa-upload fa-fw"></i> Загрузить фотографию...',
'url': '/photo/parentUpload'
},
]},
]
}) }}

{% else %}
{% set logoutTxt = ['Logout (', app.user().identity().username, ')' ]|join('') %}
{% set items = [
{'label': 'Home', 'url': '/site/index'},
{'label': 'About', 'url': '/site/about'},
{'label': 'Contact', 'url': '/site/contact'},
{'label': logoutTxt, 'url': '/site/logout', 'linkOptions': {'data-method': 'post'}}
] %}
{% endif %}
{{ nav_bar_end() }}
<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

NavBar::begin([
    'brandLabel' => Html::img('/images/is-small.png'),
    'brandOptions' => ['style' => 'padding-top: 0;'],
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-default navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => '<i class="fa fa-image"></i> Фотоальбомы', 'url' => ['/album']],
        [
            'label' => 'Родителям',
            'items' => [
                'label' => '<i class="fa fa-upload fa-fw"></i> Загрузить фотографию...',
                'url' => '/photo/parentUpload'
            ]
        ],
        ['label' => 'Contact', 'url' => ['/site/contact']],
        Yii::$app->user->isGuest ?
            ['label' => 'Login', 'url' => ['/site/login']] :
            [
                'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ],
    ],
]);
NavBar::end();
