<?php
namespace Bitixel\RegistrationValidation\Model;

use Magento\Framework\Exception\LocalizedException;

class AccountManagement extends Magento\Customer\Model\AccountManagement
{

    /**
     * {@inheritdoc}
     */
    public function createAccount(CustomerInterface $customer, $password = null, $redirectUrl = '')
    {
    
    
    	$customerEmail = $customer->getEmail();
	if (strpos($customerEmail, 'mail.ru') !== false) {
		throw new LocalizedException(__('Error: x589'));
	}
    
        if ($password !== null) {
            $this->checkPasswordStrength($password);
            $customerEmail = $customer->getEmail();
            try {
                $this->credentialsValidator->checkPasswordDifferentFromEmail($customerEmail, $password);
            } catch (InputException $e) {
                throw new LocalizedException(__('Password cannot be the same as email address.'));
            }
            $hash = $this->createPasswordHash($password);
        } else {
            $hash = null;
        }
        return $this->createAccountWithPasswordHash($customer, $hash, $redirectUrl);
    }

}
