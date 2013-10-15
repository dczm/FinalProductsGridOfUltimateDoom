<?php
class Dczm_FinalProductsGridOfUltimateDoom_Elevation_Shrubs
    extends Mage_Adminhtml_Block_Widget
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function getFieldSuffix()
    {
        return 'finalproductsgridofultimatedoom';
    }

    public function getStoreId()
    {
        $storeId = $this->getRequest()->getParam('store');
        return intval($storeId);
    }

    public function getTabLabel()
    {
        return Mage::helper('catalog')->__('Categories');
    }

    public function getTabTitle()
    {
        return Mage::helper('catalog')->__('Categories');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
	public function getShrubsHtml(){
		 $block = $this->getLayout()->createBlock(
                        'finalproductsgridofultimatedoom/shrubs_shrub', 'finalproductsgridofultimatedoom',
                        array('js_form_object' => "finalproductsgridofultimatedoom_fieldset")
                    );
		return $block->toHtml();
	}
}
