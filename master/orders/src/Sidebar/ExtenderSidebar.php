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
				$item->icon('fa fa-fw fa-rss');
				$item->url(route('admin.orders'));
			});
		});
		return $menu;
	}
}