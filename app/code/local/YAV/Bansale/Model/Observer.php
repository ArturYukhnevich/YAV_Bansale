<?php

Class YAV_Bansale_Model_Observer extends Varien_Event_Observer
{
    public function checkAvailability(Varien_Event_Observer $observer)
    {

        if (!Mage::getStoreConfig('bansale/settings/enabled')) {
            return true;
        }

        $curTime = Mage::getModel('core/date')->timestamp(time());
        $startTime = strtotime(Mage::getStoreConfig('bansale/settings/starttime'));
        $endTime = strtotime(Mage::getStoreConfig('bansale/settings/endtime'));

        if (($curTime < $startTime) && ($curTime > $endTime)) {
            return true;
        }

        $categoryIds = explode(',', Mage::getStoreConfig('bansale/settings/category'));

        $product = $observer->getProduct();
        $productCategoryIds = $product->getCategoryIds();

        if (empty(array_intersect($categoryIds, $productCategoryIds))) {
            return true;
        }

        Mage::getSingleton('checkout/cart')->truncate();

        Mage::getSingleton('core/session')->addError('Sale of alcohol is prohibited at the current time.');
        session_write_close();

        // Mage::app()->getFrontController()->getResponse()->setRedirect($_SERVER['HTTP_REFERER'])->sendResponse();

        return true;
    }
}