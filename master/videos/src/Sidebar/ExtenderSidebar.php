<?php

namespace Master\Videos\Sidebar;

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
			$group->item('Videos', function(Item $item){
				$item->icon('ni ni-book-bookmark');
				$item->url(route('admin.videos'));
			});
		});
		return $menu;
	}
}