<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;

abstract class Provider extends ServiceProvider
{
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
     * @var string
     */
    private $classDirectory;

    /**
     * Register the application services.
     */
    public function register() : void
    {
        $this->registerConfiguration();
        $this->registerListeners();
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
     * Register predefined listeners event listeners.
     */
    protected function registerListeners()
    {
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }
        foreach ($this->subscribe as $subscriber) {
            Event::subscribe($subscriber);
        }
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

    /**
     * Get the directory of the current class.
     *
     * Uses reflection to get the directory of the child class instead of the parent if applicable.
     *
     * @return string
     */
    private function getClassDirectory() : string
    {
        // Some primitive caching
        if ($this->classDirectory) {
            return $this->classDirectory;
        }

        $reflection = new ReflectionClass(get_class($this));

        $this->classDirectory = dirname($reflection->getFileName());

        return $this->classDirectory;
    }
}
