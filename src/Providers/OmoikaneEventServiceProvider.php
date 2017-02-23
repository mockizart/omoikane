<?php

namespace Omoikane\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class OmoikaneEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        'Omoikane\Observers\Events\Page\PageCreated' => [
            'Omoikane\Observers\Listeners\Ping',
        ],
        'Omoikane\Observers\Events\Page\PageUpdated' => [
            'Omoikane\Observers\Listeners\Ping',
        ],
        'Omoikane\Observers\Events\Page\PageDeleted' => [],

        'Omoikane\Observers\Events\Tag\TagCreated' => [
            'Omoikane\Observers\Listeners\Ping',
        ],
        'Omoikane\Observers\Events\Tag\TagUpdated' => [
            'Omoikane\Observers\Listeners\Ping',
        ],
        'Omoikane\Observers\Events\Tag\TagDeleted' => [],

        'Omoikane\Observers\Events\Category\CategoryCreated' => [
            'Omoikane\Observers\Listeners\Ping',
        ],
        'Omoikane\Observers\Events\Category\CategoryUpdated' => [
            'Omoikane\Observers\Listeners\Ping',
        ],
        'Omoikane\Observers\Events\Category\CategoryDeleted' => [],

        'Omoikane\Observers\Events\Article\ArticleCreated' => [
            'Omoikane\Observers\Listeners\Ping',
            'Omoikane\Observers\Listeners\ArticleTag\CreateArticleTag',
            'Omoikane\Observers\Listeners\ArticleCategory\CreateArticleCategory'
        ],
        'Omoikane\Observers\Events\Article\ArticleUpdated' => [
            'Omoikane\Observers\Listeners\Ping',
            'Omoikane\Observers\Listeners\ArticleTag\UpdateArticleTag',
            'Omoikane\Observers\Listeners\ArticleCategory\UpdateArticleCategory'
        ],
        'Omoikane\Observers\Events\Article\ArticleDeleted' => [
            'Omoikane\Observers\Listeners\ArticleTag\DeleteArticleTag',
            'Omoikane\Observers\Listeners\ArticleCategory\DeleteArticleCategory'
        ],

        'Omoikane\Observers\Events\MenuGroup\MenuGroupCreated' => [
            'Omoikane\Observers\Listeners\MenuMember\CreateMenuMember',
        ],

        'Omoikane\Observers\Events\MenuGroup\MenuGroupUpdated' => [
            'Omoikane\Observers\Listeners\MenuMember\UpdateMenuMember',
        ],

        'Omoikane\Observers\Events\MenuGroup\MenuGroupDeleted' => [
            'Omoikane\Observers\Listeners\MenuMember\DeleteMenuMember',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
