<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Show;
use App\Models\Booking;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('show_stat', function (User $user, Show $show)  {
            if ($user->role_id == '1' || $user->id == $show->admin_id)
                return true;
            return false;
        });

        Gate::define('show_ticket', function (User $user, Booking $booking)  {
            if ($user->role_id == '1' || $user->id == $booking->show->admin_id ||  $user->id == $booking->customer_id )
                return true;
            return false;
        });


        //
    }
}
