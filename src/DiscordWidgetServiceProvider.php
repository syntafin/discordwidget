<?php

namespace Syntafin\DiscordWidget;

use Syntafin\DiscordWidget\Components\Widget;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class DiscordWidgetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('discord-widget', Widget::class);

        $this->loadViewsFrom(__DIR__ . '/views', 'discord-widget');
        $this->loadTranslationsFrom(__DIR__ . '/lang', 'discord-widget');
        $this->mergeConfigFrom(__DIR__ . '/config.php', 'discord-widget');
    }
}
