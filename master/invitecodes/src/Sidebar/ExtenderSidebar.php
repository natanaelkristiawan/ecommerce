<?php

namespace Master\Invitecodes\Sidebar;

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
			$group->item('Invite Codes', function(Item $item){
				$item->icon('ni ni-check-bold text-pink');
				$item->url(route('admin.invitecodes'));
			});
		});
		return $menu;
	}
}