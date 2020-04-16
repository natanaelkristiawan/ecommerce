<?php

namespace Master\Orders\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Sidebar;
use Maatwebsite\Sidebar\SidebarExtender;


class ExtenderSidebar implements SidebarExtender 
{
	public function extendWith(Menu $menu)
	{
		$menu->group('Main Navigator', function(Group $group) {
			$group->item('Orders', function(Item $item){
				$item->icon('ni ni-cart text-purple');
        $item->url('orders');
				$item->item('Pending', function(Item $item){
          $item->url(route('admin.orderPending'));
        });
        
        $item->item('Success', function(Item $item){
          $item->url(route('admin.orderSuccess'));
        });
			});
		});
		return $menu;
	}
}