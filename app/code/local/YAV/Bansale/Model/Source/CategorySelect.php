<?php

class YAV_Bansale_Model_Source_CategorySelect
{
    private $categories = [];

    public function __construct()
    {
        $this->getAllCategories();
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $categories = [];
        foreach ($this->categories as $category) {
            $categories[] = ['value' => $category->getId(), 'label' => Mage::helper('bansale')->__($category->getName())];
        }

        return $categories;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $categories = [];
        foreach ($this->categories as $category) {
            $categories[$category->getId()] = Mage::helper('bansale')->__($category->getName());
        }

        return $categories;
    }

    private function getAllCategories()
    {
        $this->categories = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addIsActiveFilter()
            ->addLevelFilter(2)
            ->addOrderField('name');
    }

}