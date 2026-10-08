<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $contact       = \App\Models\Contact::latest('id')->first();
            $pmbSetting    = \App\Models\PmbSetting::first();
            $navProdis     = \App\Models\Layanan::where('aktif', true)->orderBy('urutan')->get();
            $navPublikasis = \App\Models\Publikasi::where('aktif', true)->orderBy('urutan')->get();
            $topbarSetting = \App\Models\Topbar::where('is_active', true)->latest('id')->first();

            $cleanWa = '';
            $waSource = $topbarSetting?->telepon ?? $contact?->no_wa ?? '';
            if (!empty($waSource)) {
                $cleanWa = preg_replace('/[^0-9]/', '', $waSource);
                if (strpos($cleanWa, '08') === 0) {
                    $cleanWa = '628' . substr($cleanWa, 2);
                }
            }

            $view->with([
                'contact'       => $contact,
                'cleanWa'       => $cleanWa,
                'pmbSetting'    => $pmbSetting,
                'navProdis'     => $navProdis,
                'navPublikasis' => $navPublikasis,
                'topbarSetting' => $topbarSetting,
            ]);
        });
    }
}
