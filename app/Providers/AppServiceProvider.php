<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        
        //Búsqueda con macro
        Builder::macro('search',function($field, $string){
            return $string ? $this->where($field, 'like', '%'.$string.'%') : $this;
        });

        Builder::macro('toCsv',function(){
            $results = $this->get();

            if($results->count() < 1) return;

            $titles = implode(',', array_keys((array) $results->first()->getAttributes()));

            $values = $results->map(function ($result){
                return implode(',', collect($result->getAttributes())->map(function ($thing){
                    return '"'.$thing.'"';
                })->toArray());
            });

            $values->prepend($titles);

            return $values->implode("\n");
        });
    }
}
