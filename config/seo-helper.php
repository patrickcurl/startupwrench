<?php

return [
    /* ------------------------------------------------------------------------------------------------
     |  Title
     | ------------------------------------------------------------------------------------------------
     */
    'title' => [
        'default'   => 'StartupWrench',
        'site-name' => '',
        'separator' => '-',
        'first'     => true,
        'max'       => 55,
    ],

    /* ------------------------------------------------------------------------------------------------
     |  Description
     | ------------------------------------------------------------------------------------------------
     */
    'description' => [
        'default'   => 'Tools and resources for startups',
        'max'       => 155,
    ],

    /* ------------------------------------------------------------------------------------------------
     |  Keywords
     | ------------------------------------------------------------------------------------------------
     */
    'keywords'  => [
        'default'   => [
            // 
            'startups', 'startup', 'startup tools', 'startup links', 'startup resources'
        ],
    ],

    /* ------------------------------------------------------------------------------------------------
     |  Miscellaneous
     | ------------------------------------------------------------------------------------------------
     */
    'misc'      => [
        'canonical' => true,
        'robots'    => ! app()->environment('production'),  // Tell robots not to index the content if it's not on production
        'default'   => [
            'viewport'  => 'width=device-width, initial-scale=1', // Responsive design thing
            'author'    => '', // https://plus.google.com/[YOUR PERSONAL G+ PROFILE HERE]
            'publisher' => '', // https://plus.google.com/[YOUR PERSONAL G+ PROFILE HERE]
        ],
    ],

    /* ------------------------------------------------------------------------------------------------
     |  Webmaster Tools
     | ------------------------------------------------------------------------------------------------
     */
    'webmasters' => [
        'google'    => '',
        'bing'      => '',
        'alexa'     => '',
        'pinterest' => '',
        'yandex'    => '',
    ],

    /* ------------------------------------------------------------------------------------------------
     |  Open Graph
     | ------------------------------------------------------------------------------------------------
     */
    'open-graph' => [
        'enabled'     => true,
        'prefix'      => 'og:',
        'type'        => 'website',
        'title'       => 'StartupWrench',
        'description' => '400+ Startup tools and resources.',
        'site-name'   => '',
        'properties'  => [
            //
        ],
    ],

    /* ------------------------------------------------------------------------------------------------
     |  Twitter
     | ------------------------------------------------------------------------------------------------
     |  Supported card types : 'app', 'gallery', 'photo', 'player', 'product', 'summary', 'summary_large_image'.
     */
    'twitter' => [
        'enabled' => true,
        'prefix'  => 'twitter:',
        'card'    => 'summary',
        'site'    => 'startupwrench',
        'title'   => 'StartupWrench.com',
        'metas'   => [
            //
        ],
    ],

    /* ------------------------------------------------------------------------------------------------
     |  Analytics
     | ------------------------------------------------------------------------------------------------
     */
    'analytics' => [
        'google' => 'UA-71554377-1', // UA-XXXXXXXX-X
    ],
];
