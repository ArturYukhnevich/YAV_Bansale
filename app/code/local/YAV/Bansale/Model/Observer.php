<?php

Class YAV_Bansale_Model_Observer extends Varien_Event_Observer
{
    /**
     * @param Varien_Event_Observer $observer
     * @return bool
     * @throws Mage_Core_Exception
     */
    public function checkout_cart_product_add_after(Varien_Event_Observer $observer)
    {
        /**
         * @var $helper YAV_Bansale_Helper_Data
         */
        $helper = Mage::helper('bansale');

        $product = $observer->getProduct();

        if ($helper->checkAvailabilityProduct($product)) {
            Mage::throwException(sprintf('Sale of alcohol is prohibited at the current time!'));
        }

        return true;
    }


    /**
     * @param Varien_Event_Observer $observer
     * @throws Mage_Core_Exception
     */
    public function sales_order_place_before(Varien_Event_Observer $observer)
    {
        /**
         * @var YAV_Bansale_Helper_Data $helper
         */
        $helper = Mage::helper('bansale');

        /**
         * @var Mage_Sales_Model_Order $order
         */
        $order = $observer->getOrder();
        $items = $order->getAllItems();

        foreach ($items as $item) {

            /**
             * @var $item Mage_Sales_Model_Order_Item
             */
            $productId = $item->getProduct()->getId();

            /**
             * @var $product Mage_Catalog_Model_Product
             */
            $product = Mage::getModel('catalog/product')->load($productId);

            if ($helper->checkAvailabilityProduct($product)) {
                Mage::throwException(sprintf('Sale of alcohol is prohibited at the current time!'));
            }
        }
    }
}