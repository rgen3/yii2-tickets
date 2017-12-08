<?php

namespace rgen3\tickets\assets;

use yii\web\AssetBundle;

class ticketAsset extends AssetBundle
{
    public $sourcePath =  '@vendor/rgen3/yii2-tickets';
    public $css = [
        'css/ticket.css'
    ];
    public $js = [
        'js/ticket.js'
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
}