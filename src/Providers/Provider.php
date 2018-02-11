<?php

namespace SebastiaanLuca\Flow\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use SebastiaanLuca\Helpers\Classes\ProvidesClassInfo;

abstract class Provider extends ServiceProvider
{
    use ProvidesClassInfo;

    /**
     * The class bindings to register.
     *
     * @var array
     */
    public $bindings = [];

    /**
     * The class singletons to register.
     *
     * @var array
     */
    public $singletons = [];

    /**
     * The classes to alias to another namespace or name.
     *
     * @var array
     */
    protected $aliases = [];

    /**
     * The routers to be automatically mapped.
     *
     * @var array
     */
    protected $routers = [];

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->aliasClasses();
        $this->registerConfiguration();
        $this->bindRepositories();
        $this->registerCommands();
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadPublishableResources();
        $this->mapMorphTypes();
        $this->bootMiddleware(app(Kernel::class), app('router'));
        $this->mapPredefinedRoutes();
        $this->mapRoutes();
    }

    /**
     * Alias all predefined classes.
     */
    protected function aliasClasses() : void
    {
        foreach ($this->aliases as $alias => $class) {
            if (! class_exists($alias)) {
                class_alias($class, $alias);
            }
        }
    }

    /**
     * Automatically register and merge all configuration files found in the package with the ones
     * published by the user.
     */
    protected function registerConfiguration()
    {
        $configuration = $this->getClassDirectory() . "/../../config/{$this->getPackageName()}.php";

        if (! file_exists($configuration)) {
            return;
        }

        $this->mergeConfigFrom(
            $configuration,
            str_replace('/', '.', $this->getPackageName())
        );
    }

    /**
     * Bind concrete repositories to their interfaces.
     */
    protected function bindRepositories()
    {
        //
    }

    /**
     * Register artisan commands.
     */
    protected function registerCommands()
    {
        //
    }

    /**
     * Register all publishable module assets.
     */
    protected function loadPublishableResources()
    {
        $this->publishes([
            $this->getClassDirectory() . '/../../config' => config_path()
        ], $this->getPackageName());
    }

    /**
     * Map class morph types.
     */
    protected function mapMorphTypes()
    {
        //
    }

    /**
     * Register package middleware.
     *
     * @param Kernel $kernel
     * @param \Illuminate\Routing\Router $router
     */
    protected function bootMiddleware(Kernel $kernel, Router $router)
    {
        //
    }

    /**
     * Map out all predefined module routes.
     */
    protected function mapPredefinedRoutes()
    {
        foreach ($this->routers as $router) {
            $this->app->make($router);
        }
    }

    /**
     * Map out all module routes.
     */
    protected function mapRoutes()
    {
        //
    }

    /**
     * The lowercase name of the package.
     *
     * @return string
     */
    abstract protected function getPackageName() : string;
}
