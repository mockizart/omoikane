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
        include __DIR__.'/../routes/web.php';

//        $this->publishes([
//            __DIR__.'/../resources/assets' => public_path('/'),
//        ], 'public');

        $this->publishes([
            __DIR__.'/../resources/themes/admin/'.config('omoikane.admin_theme').'/views/layouts' =>
                resource_path('views/themes/admin/'.config('omoikane.admin_theme').'/layouts'),
        ], 'themes_view');

        $this->publishes([
            __DIR__.'/../resources/themes/admin/'.config('omoikane.admin_theme').'/assets' =>
                public_path('/themes/admin/'.config('omoikane.admin_theme')),
        ], 'themes_assets');

        $this->publishes([
            __DIR__.'/../config/omoikane.php' => config_path('omoikane.php'),
        ]);

        /// view
        $this->loadViewsFrom(__DIR__.'/../resources/themes', 'omoikane');

        // migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

    }

    public function register()
    {
        /* page */
        $this->app->bind('Omoikane\Validations\Contracts\PageValidation', 'Omoikane\Validations\PageValidation');
        $this->app->bind('Omoikane\Repositories\Contracts\PageRepository', 'Omoikane\Repositories\PageRepository');
        $this->app->bind('Omoikane\Services\Page\Contracts\PageCrud', 'Omoikane\Services\Page\PageCrud');
        $this->app->bind('Omoikane\Services\Page\Contracts\PaginatedPage', 'Omoikane\Services\Page\PaginatedPage');

        /* Category */
        $this->app->bind('Omoikane\Validations\Contracts\CategoryValidation', 'Omoikane\Validations\CategoryValidation');
        $this->app->bind('Omoikane\Repositories\Contracts\CategoryRepository', 'Omoikane\Repositories\CategoryRepository');
        $this->app->bind('Omoikane\Services\Category\Contracts\CategoryCrud', 'Omoikane\Services\Category\CategoryCrud');
        $this->app->bind('Omoikane\Services\Category\Contracts\CategoryList', 'Omoikane\Services\Category\CategoryList');

        /* tag */
        $this->app->bind('Omoikane\Validations\Contracts\TagValidation', 'Omoikane\Validations\TagValidation');
        $this->app->bind('Omoikane\Repositories\Contracts\TagRepository', 'Omoikane\Repositories\TagRepository');
        $this->app->bind('Omoikane\Services\Tag\Contracts\TagCrud', 'Omoikane\Services\Tag\TagCrud');
        $this->app->bind('Omoikane\Services\Tag\Contracts\PaginatedTag', 'Omoikane\Services\Tag\PaginatedTag');
        $this->app->bind('Omoikane\Services\Tag\Contracts\TopTags', 'Omoikane\Services\Tag\TopTags');

        /* article */
        $this->app->bind('Omoikane\Validations\Contracts\ArticleValidation', 'Omoikane\Validations\ArticleValidation');
        $this->app->bind('Omoikane\Validations\Contracts\MenuGroupValidation', 'Omoikane\Validations\MenuGroupValidation');
        $this->app->bind('Omoikane\Repositories\Contracts\ArticleRepository', 'Omoikane\Repositories\ArticleRepository');
        $this->app->bind('Omoikane\Services\Article\Contracts\ArticleCrud', 'Omoikane\Services\Article\ArticleCrud');
        $this->app->bind('Omoikane\Services\Article\Contracts\PaginatedArticle', 'Omoikane\Services\Article\PaginatedArticle');

        /* article category */
        $this->app->bind('Omoikane\Repositories\Contracts\ArticleCategoryRepository', 'Omoikane\Repositories\ArticleCategoryRepository');
        $this->app->bind('Omoikane\Services\Article\Contracts\ArticleCategoryCrud', 'Omoikane\Services\Article\ArticleCategoryCrud');

        /* article tag */
        $this->app->bind('Omoikane\Repositories\Contracts\ArticleTagRepository', 'Omoikane\Repositories\ArticleTagRepository');
        $this->app->bind('Omoikane\Services\Article\Contracts\ArticleTagCrud', 'Omoikane\Services\Article\ArticleTagCrud');

        /* menu group */
        $this->app->bind('Omoikane\Repositories\Contracts\MenuGroupRepository', 'Omoikane\Repositories\MenuGroupRepository');
        $this->app->bind('Omoikane\Services\MenuGroup\Contracts\MenuGroupCrud', 'Omoikane\Services\MenuGroup\MenuGroupCrud');
        $this->app->bind('Omoikane\Services\MenuGroup\Contracts\PaginatedMenuGroup', 'Omoikane\Services\MenuGroup\PaginatedMenuGroup');

        /* menu member */
        $this->app->bind('Omoikane\Repositories\Contracts\MenuMemberRepository', 'Omoikane\Repositories\MenuMemberRepository');
        $this->app->bind('Omoikane\Services\MenuMember\Contracts\MenuMemberCrud', 'Omoikane\Services\MenuMember\MenuMemberCrud');
        $this->app->bind('Omoikane\Services\MenuMember\Contracts\MenuMemberListByGroupId', 'Omoikane\Services\MenuMember\MenuMemberListByGroupId');
        $this->app->bind('Omoikane\Services\MenuMember\Contracts\TargetTranslator', 'Omoikane\Services\MenuMember\TargetTranslator');

        $this->app->bind('Omoikane\Services\Contracts\Pingomatic', 'Omoikane\Services\Pingomatic');
    }

}