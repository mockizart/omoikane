<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 29/01/17
 * Time: 19:21
 */

namespace Omoikane\Providers;

use Illuminate\Support\ServiceProvider;

class OmoikaneServiceProvider extends ServiceProvider{

    public function boot()
    {
        // available routes of mockblog package
        include __DIR__.'/../routes/page.php';
        include __DIR__.'/../routes/category.php';
        include __DIR__.'/../routes/tag.php';
        include __DIR__.'/../routes/article.php';
        include __DIR__.'/../routes/menu_group.php';

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('/'),
        ], 'public');

        /// view
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'omoikane');

        // migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register()
    {
        /*
         * Validation binding
         */
        $this->app->bind('Omoikane\Validations\Contracts\PageValidation', 'Omoikane\Validations\PageValidation');
        $this->app->bind('Omoikane\Validations\Contracts\TagValidation', 'Omoikane\Validations\TagValidation');
        $this->app->bind('Omoikane\Validations\Contracts\CategoryValidation', 'Omoikane\Validations\CategoryValidation');
        $this->app->bind('Omoikane\Validations\Contracts\ArticleValidation', 'Omoikane\Validations\ArticleValidation');
        $this->app->bind('Omoikane\Validations\Contracts\MenuGroupValidation', 'Omoikane\Validations\MenuGroupValidation');

        /*
         *  Repository bindings
         */
        $this->app->bind('Omoikane\Repositories\Contracts\PageRepository', 'Omoikane\Repositories\PageRepository');
        $this->app->bind('Omoikane\Repositories\Contracts\CategoryRepository', 'Omoikane\Repositories\CategoryRepository');
        $this->app->bind('Omoikane\Repositories\Contracts\TagRepository', 'Omoikane\Repositories\TagRepository');
        $this->app->bind('Omoikane\Repositories\Contracts\ArticleRepository', 'Omoikane\Repositories\ArticleRepository');
        $this->app->bind('Omoikane\Repositories\Contracts\ArticleCategoryRepository', 'Omoikane\Repositories\ArticleCategoryRepository');
        $this->app->bind('Omoikane\Repositories\Contracts\ArticleTagRepository', 'Omoikane\Repositories\ArticleTagRepository');
        $this->app->bind('Omoikane\Repositories\Contracts\MenuGroupRepository', 'Omoikane\Repositories\MenuGroupRepository');
        $this->app->bind('Omoikane\Repositories\Contracts\MenuMemberRepository', 'Omoikane\Repositories\MenuMemberRepository');


        /*
         * Service crud bindings
         */
        $this->app->bind('Omoikane\Services\Article\Contracts\ArticleCrud', 'Omoikane\Services\Article\ArticleCrud');
        $this->app->bind('Omoikane\Services\Article\Contracts\PaginatedArticle', 'Omoikane\Services\Article\PaginatedArticle');

        $this->app->bind('Omoikane\Services\Page\Contracts\PageCrud', 'Omoikane\Services\Page\PageCrud');
        $this->app->bind('Omoikane\Services\Page\Contracts\PaginatedPage', 'Omoikane\Services\Page\PaginatedPage');

        $this->app->bind('Omoikane\Services\Category\Contracts\CategoryCrud', 'Omoikane\Services\Category\CategoryCrud');

        $this->app->bind('Omoikane\Services\Tag\Contracts\TagCrud', 'Omoikane\Services\Tag\TagCrud');
        $this->app->bind('Omoikane\Services\Tag\Contracts\PaginatedTag', 'Omoikane\Services\Tag\PaginatedTag');

        $this->app->bind('Omoikane\Services\MenuMember\Contracts\MenuMemberCrud', 'Omoikane\Services\MenuMember\MenuMemberCrud');
        $this->app->bind('Omoikane\Services\MenuMember\Contracts\MenuMemberListByGroupId', 'Omoikane\Services\MenuMember\MenuMemberListByGroupId');

        $this->app->bind('Omoikane\Services\MenuGroup\Contracts\MenuGroupCrud', 'Omoikane\Services\MenuGroup\MenuGroupCrud');
        $this->app->bind('Omoikane\Services\MenuGroup\Contracts\PaginatedMenuGroup', 'Omoikane\Services\MenuGroup\PaginatedMenuGroup');

        $this->app->bind('Omoikane\Services\Article\Contracts\ArticleCategoryCrud', 'Omoikane\Services\Article\ArticleCategoryCrud');
        $this->app->bind('Omoikane\Services\Article\Contracts\ArticleTagCrud', 'Omoikane\Services\Article\ArticleTagCrud');

        /*
         * Service bindings
         */
        $this->app->bind('Omoikane\Services\Category\Contracts\CategoryList', 'Omoikane\Services\Category\CategoryList');
        $this->app->bind('Omoikane\Services\MenuMember\Contracts\TargetTranslator', 'Omoikane\Services\MenuMember\TargetTranslator');
    }

}