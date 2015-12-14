<?php
namespace App\Http\Middleware;
use Closure;
class Dashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->registerSidebarMenu();
        return $next($request);
    }
    protected function registerSidebarMenu()
    {
        $menu = app('laravel_dashboard')->getSidebarMenu();
        // $assetSubMenu = app('menu.manager')->createMenu('Custom assets')
        //     ->addLink('Assets in the header', 
        //         ['route' => 'customise.assets.head'], 
        //         ['before' => '<i class="fa fa-circle-o"></i>']
        //     )->addLink('Assets in the footer', 
        //         ['route' => 'customise.assets.foot'], 
        //         ['before' => '<i class="fa fa-circle-o"></i>']
        //    );
        
        // $cusSubMenu = app('menu.manager')->createMenu('View Customization')
        //     ->addLink('General', 
        //         ['route' => 'customise.index'], 
        //         ['before' => '<i class="fa fa-circle-o"></i>']
        //     )
        //     ->addLink('Logo', 
        //         ['route' => 'customise.logo'], 
        //         ['before' => '<i class="fa fa-circle-o"></i>']
        //     )
        //     ->addLink('Top bar', 
        //         ['route' => 'customise.topbar'], 
        //         ['before' => '<i class="fa fa-circle-o"></i>']
        //     )
        //     ->addLink('Sidebar', 
        //         ['route' => 'customise.sidebar'], 
        //         ['before' => '<i class="fa fa-circle-o"></i>']
        //     )
        //     ->addLink('Footer', 
        //         ['route' => 'customise.footer'], 
        //         ['before' => '<i class="fa fa-circle-o"></i>']
        //     )
        //     ->addSubMenu($assetSubMenu, 
        //         ['before' => '<i class="fa fa-asterisk"></i>', 
        //         'url_def' => ['route_pattern' => 'customise.assets.*']]
        //     );

        $resSubMenu = app('menu.manager')->createMenu('Resources')
            ->addLink('Edit Resources',
                ['route' => 'res.edit'],
                ['before' => '<i class="fa-pencil-square-o"></i>'])
            ->addLink('Edit Links',
                ['route' => 'res.links'],
                ['before' => '<i class="fa-pencil-square-o"></i>']);

        $menu->setLabel('Main Sidebar')
            ->addLink('Main', 
                ['route' => 'home'], 
                ['before' => '<i class="fa fa-home"></i>'])
            ->addLink('Topics', 
                ['route' => 'topics'], 
                ['before' => '<i class="fa fa-cog"></i>'])
            // ->addLink('Resources', 
            //     ['route' => 'resources'], 
            //     ['before' => '<i class="fa fa-cog"></i>'])
            ->addSubMenu($resSubMenu,
                ['before' => '<i class="fa fa-industry"></i>'],
                ['url_def' => ['route_pattern' => 'res.*']]);
    }
}