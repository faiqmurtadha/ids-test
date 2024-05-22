<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CompanyRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\PositionRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\PositionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CompanyRepositoryInterface::class,CompanyRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class,EmployeeRepository::class);
        $this->app->bind(PositionRepositoryInterface::class,PositionRepository::class);
        $this->app->bind(RoleRepositoryInterface::class,RoleRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
