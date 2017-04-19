<?php namespace VnsModules\Page;

use Illuminate\Support\ServiceProvider;
use VnSource\Traits\ModuleServiceProviderTrait;

class ModuleServiceProvider extends ServiceProvider
{
    use ModuleServiceProviderTrait;

    public $hookView = [
        'admin.layout' => 'hook.admin'
    ];
    public $gadgetGroup = [

    ];
    public $permissions = [
      'page' => 'Page management',
    ];
    public $castPost = [
        'VnsModules\Page\Page' => 'VnsModules\Page\Controllers\PageController'
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->initializationModule();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            PageRepositoryInterface::class,
            PageRepository::class
        );
    }
}
