<?php

return [
    'avatar' => env('DISCORD_AVATAR', true),

    'server' => env('DISCORD_SERVER', null),

    /**
     * Set the colors used for the widget
     *
     */
    'colors' => [
        'ringColor' => 'ring-white',
        'background' => 'bg-white',
        'border' => 'border-gray-300',
        'borderHover' => 'hover:border-gray-400',
        'text' => 'text-gray-900',
        'textSub' => 'text-gray-500',
    ],

    /**
     * If set to true, the included CSS is used,
     * you can set to false if you use TailwindCSS in your project.
     *
     * If you want to use your own CSS, set this to false and
     * add the Blade files to the content array in your
     * TailwindCSS config file.
     *
     */
    'include_css' => 'true',

    /**
     * Set to true, to use FontAwesome 6 icons.
     *
     */
    'fontawesome' => env('DISCORD_FONTAWESOME', false),
];
