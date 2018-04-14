<?php
namespace Mobiosolutions\Banner\Block\Adminhtml\Banner\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
		
        parent::_construct();
        $this->setId('checkmodule_banner_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Banner Information'));
    }

    protected function _prepareLayout()
    {
        
    }
}