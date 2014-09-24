<?php


namespace Economic\Api\Debtor;


use Economic\Api\Object;

class Debtor extends Object
{
    protected $handle;
    protected $name;
    protected $number;
    protected $vatZone; //HomeCountry or EU or Abroad

    protected $required = array("number", "name", "vatZone", "isAccessible", "termOfPaymentHandle", "currency");

    protected $debtorGroupHandle = array("Number" => 1);
    protected $extendedVatZone;
    protected $currencyHandle;
    protected $priceGroupHandle;
    protected $isAccessible;
    protected $ean;
    protected $publicEntryNumber;
    protected $email;
    protected $telephoneAndFaxNumber;
    protected $website;
    protected $address;
    protected $postalCode;
    protected $city;
    protected $country;
    protected $creditMaximum;
    protected $vatNumber;
    protected $county;
    protected $CINumber;
    protected $termOfPaymentHandle = array("Id" => 1);
    protected $layoutHandle;
    protected $attentionHandle;
    protected $yourReferenceHandle;
    protected $ourReferenceHandle;
    protected $balance;

    /**
     * @param mixed $vatZone
     */
    public function setVatZone($vatZone)
    {
        $this->vatZone = $vatZone;
    }

    /**
     * @return mixed
     */
    public function getVatZone()
    {
        return $this->vatZone;
    }

    /**
     * @param mixed $vatNumber
     */
    public function setVatNumber($vatNumber)
    {
        $this->vatNumber = $vatNumber;
    }

    /**
     * @return mixed
     */
    public function getVatNumber()
    {
        return $this->vatNumber;
    }

    /**
     * @param mixed $termOfPaymentHandle
     */
    public function setTermOfPaymentHandle($termOfPaymentHandle)
    {
        $this->termOfPaymentHandle = $termOfPaymentHandle;
    }

    /**
     * @return mixed
     */
    public function getTermOfPaymentHandle()
    {
        return $this->termOfPaymentHandle;
    }

    /**
     * @param mixed $telephoneAndFaxNumber
     */
    public function setTelephoneAndFaxNumber($telephoneAndFaxNumber)
    {
        $this->telephoneAndFaxNumber = $telephoneAndFaxNumber;
    }

    /**
     * @return mixed
     */
    public function getTelephoneAndFaxNumber()
    {
        return $this->telephoneAndFaxNumber;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $publicEntryNumber
     */
    public function setPublicEntryNumber($publicEntryNumber)
    {
        $this->publicEntryNumber = $publicEntryNumber;
    }

    /**
     * @return mixed
     */
    public function getPublicEntryNumber()
    {
        return $this->publicEntryNumber;
    }


    /**
     * @param mixed $CINumber
     */
    public function setCINumber($CINumber)
    {
        $this->CINumber = $CINumber;
    }

    /**
     * @return mixed
     */
    public function getCINumber()
    {
        return $this->CINumber;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $attentionHandle
     */
    public function setAttentionHandle($attentionHandle)
    {
        $this->attentionHandle = $attentionHandle;
    }

    /**
     * @return mixed
     */
    public function getAttentionHandle()
    {
        return $this->attentionHandle;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $county
     */
    public function setCounty($county)
    {
        $this->county = $county;
    }

    /**
     * @return mixed
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @param mixed $creditMaximum
     */
    public function setCreditMaximum($creditMaximum)
    {
        $this->creditMaximum = $creditMaximum;
    }

    /**
     * @return mixed
     */
    public function getCreditMaximum()
    {
        return $this->creditMaximum;
    }

    /**
     * @param mixed $currencyHandle
     */
    public function setCurrencyHandle($currencyHandle)
    {
        $this->currencyHandle = $currencyHandle;
    }

    /**
     * @return mixed
     */
    public function getCurrencyHandle()
    {
        return $this->currencyHandle;
    }

    /**
     * @param array $debtorGroupHandle
     */
    public function setDebtorGroupHandle($debtorGroupHandle)
    {
        $this->debtorGroupHandle = $debtorGroupHandle;
    }

    /**
     * @return array
     */
    public function getDebtorGroupHandle()
    {
        return $this->debtorGroupHandle;
    }

    /**
     * @param mixed $ean
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
    }

    /**
     * @return mixed
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $extendedVatZone
     */
    public function setExtendedVatZone($extendedVatZone)
    {
        $this->extendedVatZone = $extendedVatZone;
    }

    /**
     * @return mixed
     */
    public function getExtendedVatZone()
    {
        return $this->extendedVatZone;
    }

    /**
     * @param mixed $handle
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    }

    /**
     * @return mixed
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @param mixed $isAccessible
     */
    public function setIsAccessible($isAccessible)
    {
        $this->isAccessible = $isAccessible;
    }

    /**
     * @return mixed
     */
    public function getIsAccessible()
    {
        return $this->isAccessible;
    }

    /**
     * @param mixed $layoutHandle
     */
    public function setLayoutHandle($layoutHandle)
    {
        $this->layoutHandle = $layoutHandle;
    }

    /**
     * @return mixed
     */
    public function getLayoutHandle()
    {
        return $this->layoutHandle;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $ourReferenceHandle
     */
    public function setOurReferenceHandle($ourReferenceHandle)
    {
        $this->ourReferenceHandle = $ourReferenceHandle;
    }

    /**
     * @return mixed
     */
    public function getOurReferenceHandle()
    {
        return $this->ourReferenceHandle;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $priceGroupHandle
     */
    public function setPriceGroupHandle($priceGroupHandle)
    {
        $this->priceGroupHandle = $priceGroupHandle;
    }

    /**
     * @return mixed
     */
    public function getPriceGroupHandle()
    {
        return $this->priceGroupHandle;
    }

    /**
     * @param array $propsProtected
     */
    public function setPropsProtected($propsProtected)
    {
        $this->propsProtected = $propsProtected;
    }

    /**
     * @return array
     */
    public function getPropsProtected()
    {
        return $this->propsProtected;
    }


}
