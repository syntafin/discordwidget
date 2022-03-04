<?php

return [
    'avatar' => env('DISCORD_AVATAR', true),

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