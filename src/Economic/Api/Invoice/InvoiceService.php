<?php


namespace Economic\Api\Invoice;


use Economic\Api\Service;
use Economic\Api;

class InvoiceService extends Service
{
    public function findByOtherReference($number)
    {
        $this->client->connect();
        try{
            $response = $this->client->Invoice_FindByOtherReference(array("otherReference" => $number));
            if(!isset($response->CurrentInvoice_FindByOtherReferenceResult) || !isset($response->CurrentInvoice_FindByOtherReferenceResult->Number)) {
                throw new Api\Exception\InvoiceNotFoundException(sprintf("The Invoice with %s couldn't be found", $number));
            }

            $invoice = new Invoice();
            $invoice->setHandle((array)$response->Invoice_FindByOtherReferenceResult);

            return $invoice;
        } catch (\SoapFault $e) {
            throw new Api\Exception\EconomicException($e->getMessage());
        }
    }
}
