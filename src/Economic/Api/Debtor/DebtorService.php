<?php


namespace Economic\Api\Debtor;


use Economic\Api;
use Economic\Api\Exception\Debtor\DebtorNotFoundException;

class DebtorService extends Api\Service
{
    public function findByNumber($number)
    {
        $this->client->connect();
        try{
            $response = $this->client->Debtor_FindByNumber(array("number" => $number));
            if(!isset($response->Debtor_FindByNumberResult)) {
                throw new DebtorNotFoundException(sprintf("The Debtor with %s couldn't be found", $number));
            }

            $debtor = new Debtor();
            $debtor->setHandle((array)$response->Debtor_FindByNumberResult);

            return $debtor;
        } catch (\SoapFault $e) {
            throw new Api\Exception\EconomicException($e->getMessage());
        }
    }

    public function createFromData(Debtor $debtor)
    {
        $this->client->connect();
        try {
            $data = array("data" => $debtor->toArray());
            try {
                $temp = $this->findByNumber($debtor->getNumber());
                $debtor->setHandle($temp->getHandle());

                return $debtor;
            } catch (DebtorNotFoundException $e) {
                $response = $this->client->Debtor_CreateFromData($data);
                if (isset($response->Debtor_CreateFromDataResult)) {
                    $debtor->setHandle((array)$response->Debtor_CreateFromDataResult);

                    return $debtor;
                }
            }
        } catch (\SoapFault $e) {
            throw $e;
        }
    }


    public function getData(Debtor $debtor)
    {
        throw new \Exception("Method 'getData' is not implemented yet");
        $this->client->connect();
        try {
            $data     = array("entityHandle" => $debtor->getHandle());
            $response = $this->client->Debtor_GetData($data);
            if (isset($response->Product_GetDataResult)) {
                //TODO: implement a generic setter

                return $debtor;
            }
            throw new DebtorNotFoundException();
        } catch (\SoapFault $e) {
            throw $e;
        }
    }
}
