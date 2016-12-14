<?php

namespace P4\Providers;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use P4\Movie;
use P4\Policies\MoviePolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'P4\Model'   => 'P4\Policies\ModelPolicy',
        Movie::class => MoviePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
