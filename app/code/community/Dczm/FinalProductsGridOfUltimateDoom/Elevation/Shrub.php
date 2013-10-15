<?php
class Dczm_FinalProductsGridOfUltimateDoom_Elevation_Shrub extends Mage_Adminhtml_Block_Catalog_Category_Tree
{
	public function getLoadTreeUrl($expanded=null)
    {
        return $this->getUrl('*/catalog_category/categoriesJson', array('_current'=>true));
    }
	
	public function getCategory(){
		$filter = Mage::getSingleton('adminhtml/session')->getData("productGridproduct_filter");
		if (is_string($filter)) {
                $data = $this->helper('adminhtml')->prepareFilterString($filter);
          		if(isset($data['finalproductsgridofultimatedoom_categories']))
				{
					$category = Mage::getModel('catalog/category')->load($data['finalproductsgridofultimatedoom_categories']);
					Mage::unregister('category');
					Mage::register('category',$category);
				}
            }
		return parent::getCategory();
		}
	
}