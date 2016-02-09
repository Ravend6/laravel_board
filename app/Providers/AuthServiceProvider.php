<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        App\Album::class => App\Policies\AlbumPolicy::class,
        'App\User' => 'App\Policies\UserPolicy',
        'App\Proposition' => 'App\Policies\PropositionPolicy',
        'App\Task' => 'App\Policies\TaskPolicy',
        'App\Study' => 'App\Policies\StudyPolicy',
        'App\Experience' => 'App\Policies\ExperiencePolicy',
        // \App\Tag::class => \App\Policies\TagPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
        // $gate->define('show-article', function ($user, $article) {
        //     // return $user->id == $article->user_id;
        //     return $user->owns($article);
        // });

        // $gate->define('edit-article', function ($user, $article) {
        //     return $user->id == $article->user_id;
        // });
    }
}
