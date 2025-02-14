<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Review;
use Inertia\Inertia;

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
        Vite::prefetch(concurrency: 3);

        DB::listen(function ($query) {
            $sql = $query->sql;
            $bindings = $query->bindings;
            $time = $query->time;

            $sql = $this->replaceBindings($sql, $bindings);

            Log::info(
                $sql . ' [' . $time . 'ms]'
            );
        });

        JsonResource::withoutWrapping();

        Inertia::share([
            'imageTypes' => Review::imageTypes(),
        ]);
    }

    protected function replaceBindings($sql, $bindings)
    {
        $index = 0;
        return preg_replace_callback('/\?/', function ($match) use ($bindings, &$index) {
            return $bindings[$index++];
        }, $sql);
    }
}
