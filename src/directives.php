<?php

use Illuminate\Support\Str;

return [
    /*
     |--------------------------------------------------------------------------
     | Directives
     |--------------------------------------------------------------------------
     |
     | Here you may specify custom directives for Blade views.
     |
     */

    'discordWidget' => function () {
        if (config('discord-widget.include_css')) {
            return '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/discord-widget@1/dist/css/widget.css">';
        }

        return '';
    }
];
