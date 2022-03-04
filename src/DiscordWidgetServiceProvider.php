<?php

namespace Syntafin\DiscordWidget;

use Illuminate\Support\Facades\View;
use Syntafin\DiscordWidget\Components\Widget;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;

class DiscordWidgetServiceProvider extends ServiceProvider {
    public function boot() {
        Livewire::component('discord-widget', Widget::class);

        View::composer('discord-widget', function ($view) {
            if(config('discord-widget.include_css')) {
                $view->cssPath = __DIR__ . '/../resources/css/discord-discord-widget.css';
            }
        });

        $this->publishes([
            __DIR__.'/config.php' => config_path('discord-widget.php'),
        ]);

        $this->loadViewsFrom(__DIR__.'/views', 'discord-widget');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'discord-widget');
        $this->mergeConfigFrom(__DIR__.'/config.php', 'discord-widget');
    }

    public function registerDirectives()
    {
        $directives = require __DIR__.'/directives.php';

        collect($directives)->each(function ($item, key) {
            Blade::directive(key, $item);
        });
    }
}