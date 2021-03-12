<?php

namespace Fico7489\AdminForm;

use Collective\Html\HtmlBuilder;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;

class HtmlServiceProvider extends ServiceProvider implements DeferrableProvider
{
    protected $directives = [
        'entities',
        'decode',
        'script',
        'style', 'image',
        'favicon',
        'link',
        'secureLink',
        'linkAsset',
        'linkSecureAsset',
        'linkRoute',
        'linkAction',
        'mailto',
        'email',
        'ol',
        'ul',
        'dl',
        'meta',
        'tag',
        'open',
        'model',
        'close',
        'token',
        'label',
        'input',
        'text',
        'password',
        'hidden',
        'email',
        'tel',
        'number',
        'date',
        'datetime',
        'datetimeLocal',
        'time',
        'url',
        'file',
        'textarea',
        'select',
        'selectRange',
        'selectYear',
        'selectMonth',
        'getSelectOption',
        'checkbox',
        'radio',
        'reset',
        'image',
        'color',
        'submit',
        'button',
        'old',
    ];

    public function register()
    {
        $this->registerHtmlBuilder();

        $this->registerFormBuilder();

        $this->app->alias('html', HtmlBuilder::class);
        $this->app->alias('form', FormBuilder::class);

        $this->registerBladeDirectives();
    }

    public function provides()
    {
        return ['html', 'form', HtmlBuilder::class, FormBuilder::class];
    }

    protected function registerHtmlBuilder()
    {
        $this->app->singleton('html', function ($app) {
            return new HtmlBuilder($app['url'], $app['view']);
        });
    }

    protected function registerFormBuilder()
    {
        $this->app->singleton('form', function ($app) {
            $form = new FormBuilder($app['html'], $app['url'], $app['view'], $app['session.store']->token(), $app['request']);

            return $form->setSessionStore($app['session.store']);
        });
    }

    protected function registerBladeDirectives()
    {
        $this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
            $namespaces = [
                'Html' => get_class_methods(HtmlBuilder::class),
                'Form' => get_class_methods(FormBuilder::class),
            ];

            foreach ($namespaces as $namespace => $methods) {
                foreach ($methods as $method) {
                    if (in_array($method, $this->directives)) {
                        $snakeMethod = Str::snake($method);
                        $directive = strtolower($namespace).'_'.$snakeMethod;

                        $bladeCompiler->directive($directive, function ($expression) use ($namespace, $method) {
                            return "<?php echo {$namespace}::{$method}({$expression}); ?>";
                        });
                    }
                }
            }
        });
    }
}
