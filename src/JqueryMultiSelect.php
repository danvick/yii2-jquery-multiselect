<?php

/*
 * This file is part of the 2amigos/yii2-multiselect-widget project.
 * (c) 2amigOS! <http://2amigos.us/>
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace danvick\multiselect;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

///**
// * MultiSelect renders a [David Stutz Multiselect widget](http://davidstutz.github.io/bootstrap-multiselect/)
// *
// * @see http://davidstutz.github.io/bootstrap-multiselect/
// * @author Antonio Ramirez <amigo.cobos@gmail.com>
// * @link http://www.ramirezcobos.com/
// * @link http://www.2amigos.us/
// * @package dosamigos\widgets
// */

class JqueryMultiSelect extends InputWidget
{
    /**
     * @var array data for generating the list options (value=>display)
     */
    public $data = [];
    /**
     * @var array|bool the options for the jQuery Multiselect plugin.
     *            Please refer to the jQuery Multiselect plugin Web page for possible options.
     * @see https://github.com/nobleclem/jQuery-MultiSelect#options
     */
    public $pluginOptions = [];

    /**
     * Initializes the widget.
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (empty($this->data)) {
            throw new  InvalidConfigException('"Multiselect::$data" attribute cannot be blank or an empty array.');
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeDropDownList($this->model, $this->attribute, $this->data, $this->options);
        } else {
            echo Html::dropDownList($this->name, $this->value, $this->data, $this->options);
        }
        $this->registerPlugin();
    }

    /**
     * Registers MultiSelect Bootstrap plugin and the related events
     * @return void
     */
    protected function registerPlugin()
    {
        $view = $this->getView();

        JqueryMultiSelectAsset::register($view);

        $id = $this->options['id'];

        $options = $this->pluginOptions !== false && !empty($this->pluginOptions)
            ? Json::encode($this->pluginOptions)
            : '';

        $js = "jQuery('#$id').multiselect($options);";
        $view->registerJs($js);
    }
}
