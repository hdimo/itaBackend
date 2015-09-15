<?php
/**
 * User: khaled
 * Date: 9/10/15 at 9:23 AM
 */

namespace Board\View\Helper;


use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

class SidebarHelper extends  AbstractHelper
{
    public function __invoke(){
        $viewModel = new ViewModel();
        $viewModel->setTemplate('layout/sidebar');
        return $this->getView()->render($viewModel);
    }
}