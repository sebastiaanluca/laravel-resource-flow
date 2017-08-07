<?php

namespace SebastiaanLuca\Flow\Providers;

use Illuminate\Database\Eloquent\Factory;
use Nwidart\Modules\Module;
use SebastiaanLuca\Flow\Exceptions\ModuleException;
use SebastiaanLuca\Helpers\Classes\ProvidesClassInfo;

class ModuleProvider extends Provider
{
    use ProvidesClassInfo;

    /**
     * @var \Nwidart\Modules\Module
     */
    protected $module;

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

        $this->app->make(Factory::class)->load($this->getModule()->getPath() . '/database/factories');
    }

    /**
     * Prepare all module assets.
     */
    protected function bootResources()
    {
        $this->loadMigrationsFrom($this->getModule()->getPath() . '/database/migrations');
        $this->loadTranslationsFrom($this->getModule()->getPath() . '/resources/lang', $this->getPackageName());
        $this->loadTranslationsFrom($this->getModule()->getPath() . '/resources/translations', $this->getPackageName());
        $this->loadViewsFrom($this->getModule()->getPath() . '/resources/views', $this->getPackageName());
    }

    /**
     * The lowercase name of the package.
     *
     * @return string
     * @throws \SebastiaanLuca\Flow\Exceptions\ModuleException
     */
    protected function getPackageName() : string
    {
        $configuration = $this->getClassDirectory() . '/../../module.json';

        if (! file_exists($configuration)) {
            throw ModuleException::unableToResolveModuleName();
        }

        $name = take($configuration)
            ->pipe('file_get_contents')
            ->pipe('json_decode')
            ->pipe('object_get', '$$', 'alias')
            ->get();

        if (is_null($name)) {
            throw ModuleException::unableToResolveModuleName();
        }

        return $name;
    }

    /**
     * @return \Nwidart\Modules\Module
     */
    protected function getModule() : Module
    {
        if (! $this->module) {
            $this->module = app('modules')->findOrFail($this->getPackageName());
        }

        return $this->module;
    }
}
