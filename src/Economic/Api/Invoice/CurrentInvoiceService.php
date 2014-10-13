<?php


namespace Economic\Api\Invoice;


use Economic\Api\Service;
use Economic\Api;

class CurrentInvoiceService extends Service
{
    public function findByOtherReference($number)
    {
        $this->client->connect();
        try{
            $response = $this->client->CurrentInvoice_FindByOtherReference(array("otherReference" => $number));
            if(!isset($response->CurrentInvoice_FindByOtherReferenceResult) || !isset($response->CurrentInvoice_FindByOtherReferenceResult->Number)) {
                throw new Api\Exception\InvoiceNotFoundException(sprintf("The CurrentInvoice with %s couldn't be found", $number));
            }

            $currentInvoice = new CurrentInvoice();
            $currentInvoice->setHandle((array)$response->CurrentInvoice_FindByOtherReferenceResult);

            return $currentInvoice;
        } catch (\SoapFault $e) {
            throw new Api\Exception\EconomicException($e->getMessage());
        }
    }

    public function book(CurrentInvoice $invoice)
    {
        $this->client->connect();

        try {
            $response = $this->client->CurrentInvoice_Book(array("currentInvoiceHandle" => $invoice->getHandle()));
            if (isset($response->CurrentInvoice_BookResult)) {
                $invoice->setHandle((array) $response->CurrentInvoice_BookResult);

                return $invoice;
            }
        } catch (\SoapFault $e) {
            throw $e;
        }
    }
    public function createFromData(CurrentInvoice $invoice)
    {
        $this->client->connect();
        try {
            $response = $this->client->CurrentInvoice_CreateFromData(array("data" => $invoice->toArray()));
            if (isset($response->CurrentInvoice_CreateFromDataResult)) {
                $invoice->setHandle((array) $response->CurrentInvoice_CreateFromDataResult);

                return $invoice;
            }
            var_dump($response);
        } catch (\SoapFault $e) {
            throw $e;
        }
    }

    public function createLines(CurrentInvoice $invoice)
    {
        foreach ($invoice->getLines() as $line) {
            $this->sendLine($line);
        }
        return $invoice;
    }

    private function sendLine(CurrentInvoiceLine $line)
    {
        $this->client->connect();
        try {
            $response = $this->client->CurrentInvoiceLine_CreateFromData(array("data" => $line->toArray()));
            if (isset($response->CurrentInvoiceLine_CreateFromDataResult)) {
                $line->setHandle((array) $response->CurrentInvoiceLine_CreateFromDataResult);

                return $line;
            }
            var_dump($response);
        } catch (\SoapFault $e) {
            throw $e;
        }
    }
}
