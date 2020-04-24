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


      $group->item('My Orders', function(Item $item){
        $item->icon('ni ni-cart text-green');
        $item->url('Orders');

        $item->item('Pending', function(Item $item){
          $item->url(route('public.orderPending'));
        });
        
        $item->item('Success', function(Item $item){
          $item->url(route('public.orderSuccess'));
        });
      });


      $group->item('Download Product', function(Item $item){
         $item->icon('ni ni-cloud-download-95 text-blue');
         $item->url(route('public.myproduct'));
      });

      $group->item('RG43S Management', function(Item $item){
        $item->icon('ni ni-app text-orange');
        $item->url(route('public.management'));
      });
      
      $group->item('RG43S Shortlink', function(Item $item){
        $item->icon('ni ni-ui-04 text-info');
        $item->url(route('public.management'));
      });
      
      $group->item('RG43S Antibot', function(Item $item){
        $item->icon('ni ni-building text-purple');
        $item->url(route('public.management'));
      });
      $group->item('Demo Tutorial', function(Item $item){
        $item->icon('ni ni-notification-70 text-red');
        $item->url(route('public.demo'));
      });
    });
    return $menu;
  }
}