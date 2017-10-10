<?php
/**
 * SalesDouble ReTag default Helper
 *
 * @category Popov
 * @package Popov_SalesDoubler
 * @author Popov Sergiy <popov@popov.com.ua>
 * @datetime: 20.04.14 14:54
 */
class Popov_SalesDoubler_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function setCookies() {
        $request = Mage::app()->getRequest();
        if (!$request->get('aff_id')) {
            return false;
        }

        $cookie = Mage::getSingleton('core/cookie');
        $cookie->set('SALESDOUBLER_AFF_ID', $request->get('aff_id'), time() + 7776000, '/'); // 90 days
        $cookie->set('SALESDOUBLER_AFF_SUB', $request->get('aff_sub'), time() + 7776000, '/'); // 90 days

        return true;
    }

    public function clearCookies()
    {
        //$config = Mage::getConfig()->getNode('retargeting')->asArray();
        //$utmUidName = $config['modules']['Popov_SalesDoubler']['utm_uid_name'];
        $cookie = Mage::getSingleton('core/cookie');

        $cookie->delete('SALESDOUBLER_AFF_ID');
        $cookie->delete('SALESDOUBLER_AFF_SUB');
    }
}
