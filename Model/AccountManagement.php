<?php
namespace Bitixel\RegistrationValidation\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Customer\Api\Data\CustomerInterface;

class AccountManagement extends \Magento\Customer\Model\AccountManagement
{

    public function createAccount(CustomerInterface $customer, $password = null, $redirectUrl = '')
    {

        $customerEmail = $customer->getEmail();
        $customerLastname = $customer->getLastname();
        $customerFirstname = $customer->getFirstname();
        
        if(strlen($customerFirstname)>64 || strlen($customerLastname)>64){
            throw new LocalizedException(__('Sorry, please enter valid name'));
        }

        if (strpos($customerFirstname, 'http') !== false | strpos($customerLastname, 'http') !== false) {
            throw new LocalizedException(__('Sorry, please enter valid name'));
        }

        if (strpos($customerEmail, 'mail.ru') !== false) {
            throw new LocalizedException(__('Sorry, your email address has been blacklisted'));
        }	    	
        return parent::createAccount($customer, $password, $redirectUrl);
    }

}
