<?php

namespace App;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust\Laratrust;

class MyMenuFilter implements FilterInterface
{
    public function transform($item)
    {

        if (isset($item['permission']) && $item['permission']==\Auth::User()->role) {
            $item['restricted'] = true;
        }

        // if(isset($item['route']) && $item['route']=='services.index')
        // {
        //     unset($item);
        //     return $item;
        // }

        // print_r(request()->route()->middleware());
        // print_r($item); 
        // echo \Auth::User()->role;

        return $item;
    }
}