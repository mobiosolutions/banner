<?php
namespace Mobiosolutions\Banner\Block\Adminhtml;
class Banner extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
		
        $this->_controller = 'adminhtml_banner';/*block grid.php directory*/
        $this->_blockGroup = 'Mobiosolutions_Banner';
        $this->_headerText = __('Manage Banner');
        $this->_addButtonLabel = __('Add New Banner'); 
        parent::_construct();
		
    }
}
