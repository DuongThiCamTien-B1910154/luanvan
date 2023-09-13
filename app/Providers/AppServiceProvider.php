<?php

namespace App\Providers;

use App\Models\adminModel;
use App\Models\clientModel;
use App\Models\districtModel;
use App\Models\positionModel;
use App\Models\provinceModel;
use App\Models\townModel;
use App\Models\typeBusModel;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $posi = new positionModel();
        $position = $posi->getAllPosition();
        //
        $pro = new provinceModel();
        $province = $pro->getAllProvince();

        $dis = new districtModel();
        $district = $dis->getAllDistrict();

        $to = new townModel();
        $town = $to->getAllTown();

        $type = new typeBusModel();
        $typeBus = $type->getAllTypeBus();

        $user = new User();
        $users = $user->getAllUser();

        $admin = new adminModel();
        $admins = $admin->getAllAdmin();
        View::share(compact('position', 'province', 'district', 'town', 'typeBus', 'users','admins'));
    }
}
