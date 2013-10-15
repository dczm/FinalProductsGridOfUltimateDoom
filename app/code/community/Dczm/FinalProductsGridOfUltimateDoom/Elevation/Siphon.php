<?php

class Dczm_FinalProductsGridOfUltimateDoom_Elevation_Siphon extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $product = Mage::getModel('catalog/product')->load($row->getEntityId());
        $categories = $product->getCategoryIds();
        $output = '<ul>';
        foreach($categories as $key => $category)
        {
            $_category = Mage::getModel('catalog/category')->load($category);
            $output.= '<li>' . $_category->getName() . '</li>';

        }
		$output.= '</ul>';
        return $output;
    }

}
