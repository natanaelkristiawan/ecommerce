<?php 

return [
  'upload_folder' => 'core',
	'menuExtends' => [
		'\Master\Core\Sidebar\ExtenderSidebar',
    '\Master\Products\Sidebar\ExtenderSidebar',
		'\Master\Customers\Sidebar\ExtenderSidebar',
    '\Master\Orders\Sidebar\ExtenderSidebar',
    // '\Master\Articles\Sidebar\ExtenderSidebar',
    '\Master\Invitecodes\Sidebar\ExtenderSidebar',
    '\Master\Settings\Sidebar\ExtenderSidebar'
	]
];