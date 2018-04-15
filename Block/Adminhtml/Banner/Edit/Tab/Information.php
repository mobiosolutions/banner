<?php

namespace Mobiosolutions\Banner\Block\Adminhtml\Banner\Edit\Tab;

class Information extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface {

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Mobiosolutions\Banner\Helper\Data
     */
    protected $_dataHelper;

    /**
     * @var \Magento\Catalog\Model\CategoryFactory
     */
    protected $_banner;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Store\Model\System\Store $systemStore, array $data = array(), \Mobiosolutions\Banner\Helper\Data $helper, \Mobiosolutions\Banner\Model\Banner $banner
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_banner = $banner;
        $this->_dataHelper = $helper;
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm() {
        /* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('banner_banner');
        $isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');
        $htmlIdPrefix = $form->getHtmlIdPrefix();
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Banner Information')));

        if ($model->getId()) {           
			$fieldset->addField('banner_id', 'hidden', ['name' => 'banner_id']);
        }

        $fieldset->addField(
            'banner_name', 'text', array(
                'name' => 'banner_name',
                'class' => 'validate-alphanum-with-spaces',
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true
            )
        );

        $fieldset->addField(
                'link', 'text', array(
            'name' => 'link',
            'class' => 'validate-url',
            'label' => __('Links'),
            'title' => __('Links'),
            'required' => false
                )
        );

        $BannerType = array('' => 'Select', '1' => 'Cms Page', '2' => 'Category Page');
        $fieldset->addField(
                'banner_type', 'select', array(
            'name' => 'banner_type',
            'class' => 'required-entry',
            'style' => 'width:150px',
            'label' => __('Display In'),
            'title' => __('Display In'),
            'required' => true,
            'values' => $BannerType,
            'disabled' => false
                )
        );

        $fieldset->addField('cms_page', 'multiselect', array(
            'label' => 'Cms Page',
            'class' => 'required-entry',
            'name' => 'cms_page',
            'style' => 'width:250px',
            'required' => true,
            'disabled' => false,
            'values' => $this->_dataHelper->getCmsPages()
        ));

        $fieldset->addField('category', 'multiselect', array(
            'label' => 'Categories',
            'class' => 'required-entry',
            'style' => 'width:250px',
            'name' => 'category',
            'required' => true,
            'disabled' => false,
            'values' => $this->_dataHelper->getCategories()
        ));

        $fieldset->addField('banner_image', 'image', array(
            'label' => 'Banner Image',
            'name' => 'banner_image',
            'required' => true,
            'disabled' => false,
            'note' => 'Allow image type: jpg, jpeg, gif, png',
        ));

        $fieldset->addField(
                'sort_order', 'text', array(
            'name' => 'sort_order',
            'label' => __('Sort Order'),
            'title' => __('Sort Order'),
            'style' => 'width:100px',
            'class' => 'required-entry validate-digits',
            'required' => true
            )
        );

        $statusArr = array('1' => 'Active', '2' => 'Inactive');
        $fieldset->addField('status', 'select', array(
            'label' => 'Status',
            'class' => 'required-entry',
            'name' => 'status',
            'style' => 'width:150px',
            'required' => true,
            'disabled' => false,
            'values' => $statusArr
        ));

        $this->setChild(
                'form_after', $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Form\Element\Dependence')
                        ->addFieldMap("{$htmlIdPrefix}banner_type", 'banner_type')
                        ->addFieldMap("{$htmlIdPrefix}cms_page", 'cms_page')
                        ->addFieldMap("{$htmlIdPrefix}category", 'category')
                        ->addFieldDependence('cms_page', 'banner_type', '1')
                        ->addFieldDependence('category', 'banner_type', '2')
        );

        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '2' : '1');
        }
        if ($model->getBannerImage() != "") {
            $model->setData('banner_image', '/bannerslider/images' . $model->getBannerImage());
        }

        $form->setValues($model->getData());
        $this->setForm($form);


        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel() {
        return __('Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle() {
        return __('Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab() {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden() {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId) {
        return $this->_authorization->isAllowed($resourceId);
    }
}