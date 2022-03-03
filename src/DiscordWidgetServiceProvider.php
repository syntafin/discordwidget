<?php

namespace Syntafin\DiscordWidget;

use Syntafin\DiscordWidget\Components\Widget;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class DiscordWidgetServiceProvider extends ServiceProvider {
    public function boot() {
        Livewire::component('discord-widget', Widget::class);

        View::composer('discord-widget', function ($view) {
            if(config('discord-widget.include_css')) {
                $view->cssPath = __DIR__ . '/../resources/css/discord-discord-widget.css';
            }
        });

        $this->loadViewsFrom(__DIR__.'/views', 'discord-widget');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'discord-widget');
        $this->mergeConfigFrom(__DIR__.'/config.php', 'discord-widget');
    }
}