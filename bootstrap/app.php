<?php


use App\Http\Middleware\AuthAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\TrackVisitor;



require_once base_path('app/Helpers/helpers.php');

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(TrackVisitor::class);

        // middleware auth admin
        $middleware->alias([
            'authadmin' => AuthAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->withBindings([
        // 🔥 INI PENGGANTI bind()
        'path.public' => function () {
            return base_path('../public_html/profil');
        },
    ])
    ->create();
