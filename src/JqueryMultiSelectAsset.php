<?php


namespace danvick\multiselect;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class JqueryMultiSelectAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery-multiselect';

    public $js = [
        'jquery.multiselect.js'
    ];

    public $css = [
        'jquery.multiselect.css'
    ];

    public $depends = [
        JqueryAsset::class,
    ];
}
