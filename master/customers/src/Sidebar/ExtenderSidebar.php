<?php

namespace Master\Customers\Sidebar;

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
			$group->item('Customers', function(Item $item){
				$item->icon('ni ni-chart-bar-32 text-green');
				$item->url(route('admin.customers'));
			});
		});
		return $menu;
	}
}