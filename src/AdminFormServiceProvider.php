<?php

namespace Fico7489\AdminForm;

use Fico7489\Es\Commands\RecreateIndexImportData;
use Illuminate\Support\ServiceProvider;

class AdminFormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'admin_form');

        view('admin_form::form.input');

    }
}
