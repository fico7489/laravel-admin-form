<?php

namespace Fico7489\AdminForm;

use Collective\Html\HtmlBuilder;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class FormBuilder extends \Collective\Html\FormBuilder
{
    protected $label;

    public function __construct(HtmlBuilder $html, UrlGenerator $url, Factory $view, $csrfToken, Request $request = null)
    {
        parent::__construct($html, $url, $view, $csrfToken, $request);
    }

    public function __call($methodName, $args)
    {
        if (false !== strpos($methodName, 'Row')) {
            $methods = explode('Row', $methodName);
            $methodName = $methods[0];

            if (in_array($methodName, ['password', 'file'])) {
                $args[1]['class'] = $args[1]['class'] ?? '';

                $args[1]['class'] .= ' form-control';
            } elseif (in_array($methodName, ['select', 'selectRange', 'selectYear', 'checkbox', 'radio', 'checkable'])) {
                if (!isset($args[2])) {
                    $args[2] = null;
                }

                $args[3]['class'] = $args[3]['class'] ?? '';
                $args[3]['class'] .= ' form-control';

                if ('select' == $methodName && empty($args[3]['data-ajax'])) {
                    $args[3]['class'] .= ' form-control-uniform';
                }
            } else {
                if (!isset($args[1])) {
                    $args[1] = null;
                }

                $args[2]['class'] = $args[2]['class'] ?? '';
                $args[2]['class'] .= ' form-control';
            }

            $inputString = call_user_func_array([$this, $methodName], $args);

            return view('admin_form::admin.partials.form.input', ['label' => $this->getLabel(), 'name' => $args[0], 'inputString' => $inputString, 'methodName' => $methodName]);
        }

        throw new \Exception('Not supported method -> '.$methodName);
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label): self
    {
        $this->label = $label;

        return $this;
    }

    public function submit($value = null, $options = [])
    {
        return view('admin_form::admin.partials.form.submit', ['name' => $value]);
    }

    public function model($model = null, $options = [])
    {
        $route = $options['route'];
        $method = false !== strpos($route[0], 'store') ? 'post' : 'patch';
        $options['method'] = $method;

        return parent::model($model, $options);
    }

    public function currency($name, $value = null, $options = [])
    {
        $options['class'] = $options['class'] ?? '';
        $options['class'] .= ' form-currency ';

        return $this->toHtmlString('<span class="currency-wrapper">'.$this->text($name, $value, $options).'</span>');
    }

    public function checkbox($name, $value = 1, $checked = null, $options = [])
    {
        $options['style'] = $options['style'] ?? '';
        $options['style'] .= ';width: auto;';

        return $this->toHtmlString('<input value="0" name="'.$name.'" style="display: none;">'.parent::checkbox($name, $value, $checked, $options));
    }

    public function rawRow($name, $value, $options = [])
    {
        return view('admin_form::admin.partials.form.raw', ['name' => $name, 'value' => $value, 'options' => $options]);
    }
}
