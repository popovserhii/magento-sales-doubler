<?php

/**
 * Enter description here...
 *
 * @category Popov
 * @package Popov_SalesDoubler
 * @author Popov Sergiy <popow.serhii@gmail.com>
 * @datetime: 07.06.2017 17:48
 */
class Popov_SalesDoubler_Helper_PostBack extends Mage_Core_Helper_Abstract
    implements Popov_Retag_Helper_PostBackInterface
{
    public function getUrl()
    {
        $cookie = Mage::getSingleton('core/cookie');
        $backUrl = rtrim(Mage::getStoreConfig('popov_salesDoubler/settings/postback_url'), '/') . '/' . $cookie->get('SALESDOUBLER_AFF_SUB');

        return $backUrl;
    }

    public function getParams()
    {
        $order = Mage::getModel('sales/order')->load(Mage::getSingleton('checkout/session')->getLastOrderId());

        $amount = $order->getGrandTotal() - $order->getShippingAmount() - $order->getShippingTaxAmount();
        $post = [
            //'action_id' => $cookie->get('AFF_ID'),
            'trans_id' => $order->getIncrementId(),
            'sale_amount' => $amount,
            'token' => Mage::getStoreConfig('popov_salesDoubler/settings/postback_key')
        ];

        return $post;
    }

    public function sendOld()
    {
        $cookie = Mage::getSingleton('core/cookie');
		//if (!$cookie->get('AFF_ID')) {
		//	return false;
		//}
        $order = Mage::getModel('sales/order')->load(Mage::getSingleton('checkout/session')->getLastOrderId());

        //$backUrl = rtrim(Mage::getStoreConfig('popov_salesDoubler/settings/postback_url'), '/') . '/' . $cookie->get('AFF_SUB');
        $amount = $order->getGrandTotal() - $order->getShippingAmount() - $order->getShippingTaxAmount();
        $post = [
            //'action_id' => $cookie->get('AFF_ID'),
            'trans_id' => $order->getIncrementId(),
            'sale_amount' => $amount,
            'token' => Mage::getStoreConfig('popov_salesDoubler/settings/postback_key')
        ];

        parent::send($backUrl, $post);
    }
}