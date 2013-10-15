<?php
class Dczm_FinalProductsGridOfUltimateDoom_Elevation_Shrubs_Shrub  extends Mage_Adminhtml_Block_Catalog_Category_Checkboxes_Tree
{
  public function getLoadTreeUrl($expanded=null)
    {
        return $this->getUrl('*/catalog_category/categoriesJson', array('_current'=>true));
    }
}
