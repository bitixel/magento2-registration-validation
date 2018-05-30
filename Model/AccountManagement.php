<?php
namespace Bitixel\RegistrationValidation\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Customer\Api\Data\CustomerInterface;

class AccountManagement extends \Magento\Customer\Model\AccountManagement
{

    public function createAccount(CustomerInterface $customer, $password = null, $redirectUrl = '')
    {
    	$customerEmail = $customer->getEmail();
	if (strpos($customerEmail, 'mail.ru') !== false) {
		throw new LocalizedException(__('Sorry, your email address has been blacklisted'));
	}	    	
        return parent::createAccount($customer, $password, $redirectUrl);
    }

}
