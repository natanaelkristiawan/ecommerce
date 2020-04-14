<?php
namespace Module\Site\View\Creator;
use Module\Site\Sidebar\ConfigSidebar;
use Maatwebsite\Sidebar\Presentation\SidebarRenderer;
class SidebarCreator
{
  protected $sidebar;
  protected $renderer;

  public function __construct(ConfigSidebar $sidebar, SidebarRenderer $renderer)
  {
    $this->sidebar  = $sidebar;
    $this->renderer = $renderer;
  }

  public function create($view)
  {
    $view->sidebar_public = $this->renderer->render(
      $this->sidebar
    );
  }
}