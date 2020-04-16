<?php

namespace Module\Site\Sidebar;

use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Sidebar;
use Maatwebsite\Sidebar\SidebarExtender;


class ExtenderSidebar implements SidebarExtender 
{
  public function extendWith(Menu $menu)
  {
    $menu->group('Public Navigator', function(Group $group) {
      $group->item('Dashboard', function(Item $item){
        $item->url(route('dashboard'));
        $item->icon('ni ni-shop text-primary');
      });


      $group->item('Orders', function(Item $item){
        $item->icon('ni ni-box-2 text-green');
        $item->url('Orders');

        $item->item('Pending', function(Item $item){
          $item->url(route('public.orderPending'));
        });
        
        $item->item('Success', function(Item $item){
          $item->url(route('public.orderSuccess'));
        });
      });

      $group->item('Histories', function(Item $item){
        $item->icon('ni ni-archive-2 text-pink');
      });
    });
    return $menu;
  }
}