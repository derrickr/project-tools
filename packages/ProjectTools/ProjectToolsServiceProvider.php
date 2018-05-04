<?php

namespace ProjectTools;
use ProjectTools\Helpers\Helper;
use ProjectTools\Helpers\PhpToJS;
use Illuminate\Support\ServiceProvider;

class ProjectToolsServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */


    public function boot() {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
            require_once($filename);
        }
        $this->app->bind('ProjectTools\UserInterface', 'ProjectTools\Repositories\UserRepository');
        $this->app->bind('ProjectTools\ActionInterface', 'ProjectTools\Repositories\ActionRepository');
        $this->app->bind('ProjectTools\RequestInterface', 'ProjectTools\Repositories\RequestRepository');
        $this->app->bind('ProjectTools\ResourceInterface', 'ProjectTools\Repositories\ResourceRepository');
        $this->app->phptojs = new PhpToJS();
        $this->app->phptojs->put('capp', Helper::getCommonJsVar());
    }

}
