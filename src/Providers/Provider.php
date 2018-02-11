<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
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
     * The polymorphic models to map to their alias.
     *
     * @var array
     */
    protected $morphMap = [];

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [];

    /**
     * The routers to be automatically mapped.
     *
     * @var array
     */
    protected $routers = [];

    /**
     * Register the application services.
     */
    public function register() : void
    {
        $this->aliasClasses();
        $this->registerConfiguration();
    }

    /**
     * Bootstrap the application services.
     */
    public function boot() : void
    {
        $this->loadPublishableResources();
        $this->mapMorphTypes();
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
    protected function registerConfiguration() : void
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
     * Register all publishable module assets.
     */
    protected function loadPublishableResources() : void
    {
        $this->publishes(
            [$this->getClassDirectory() . '/../../config' => config_path()],
            $this->getPackageName()
        );
    }

    /**
     * Map polymorphic models to their alias.
     */
    protected function mapMorphTypes() : void
    {
        Relation::morphMap($this->morphMap);
    }

    /**
     * Map out all predefined module routes.
     */
    protected function mapRoutes() : void
    {
        foreach ($this->routers as $router) {
            $this->app->make($router);
        }
    }

    /**
     * The lowercase name of the package.
     *
     * @return string
     */
    abstract protected function getPackageName() : string;
}
