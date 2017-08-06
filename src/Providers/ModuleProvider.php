<?php

namespace SebastiaanLuca\Flow\Providers;

use Illuminate\Database\Eloquent\Factory;

class ModuleProvider extends Provider
{
    /**
     * @var \Nwidart\Modules\Module
     */
    protected $instance;

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerFactories();

        parent::register();
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->bootResources();

        parent::boot();
    }

    /**
     * Register directories containing Eloquent model factories if enabled in the current
     * environment.
     */
    protected function registerFactories()
    {
        if (! app()->environment(config('flow.development_environments'))) {
            return;
        }

        $this->app->make(Factory::class)->load($this->getModulePath() . '/database/factories');
    }

    /**
     * Prepare all module assets.
     */
    protected function bootResources()
    {
        $this->loadMigrationsFrom($this->getModulePath() . '/database/migrations');
        $this->loadViewsFrom($this->getModulePath() . '/resources/views', $this->package);
        $this->loadTranslationsFrom($this->getModulePath() . '/resources/lang', $this->package);
        $this->loadTranslationsFrom($this->getModulePath() . '/resources/translations', $this->package);
    }

    /**
     * Get the root path of the module.
     *
     * @return string
     */
    protected function getModulePath()
    {
        if (! $this->instance) {
            $this->instance = app('modules')->findOrFail($this->package);
        }

        return $this->instance->getPath();
    }
}
