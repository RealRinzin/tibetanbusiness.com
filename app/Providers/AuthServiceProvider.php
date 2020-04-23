<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        // 'App\Post' => 'App\Policies\PostPolicy',
        'App\Restaurant\RestaurantBasicInfo' => 'App\Policies\Restaurant\RestaurantPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('isOwner', function ($user, $post) {
        //     return $user->id === $post->user->id;
        // });
        // Laraval Passport
        Passport::routes();
        //Gate
        // Gate::define('isOwner', function ($user, $post) {
        //     // return $user->email !== 'geniusbulbs@gmail.com';
        //     return $user->id === $post->user->id;
        // });
    }

}
