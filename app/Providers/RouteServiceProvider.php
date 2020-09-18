<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();

        $this->mapBlogRoutes();

        $this->mapForumRoutes();

        $this->mapAdminRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "blog" and "post" routes for the blog side of application.
     *
     * @return void
     */
    protected function mapBlogRoutes()
    {
        Route::prefix('blog')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/blog.php'));

        Route::prefix('post')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/post.php'));
    }

    /**
     * Define the "forum" routes for the forum side of application.
     *
     * @return void
     */
    protected function mapForumRoutes()
    {
        Route::prefix('forum')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/forum.php'));

        Route::prefix('message')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/message.php'));
    }


    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }
}
