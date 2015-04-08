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

    public function getAll()
    {
        $this->client->connect();
        try{
            $response = $this->client->CurrentInvoice_GetAll();
            if(!isset($response->CurrentInvoice_GetAllResult)) {
                throw new Api\Exception\InvoiceNotFoundException(sprintf("Failed fetching current invoice list"));
            }
            $invoices = array();
            if (isset($response->CurrentInvoice_GetAllResult->CurrentInvoiceHandle)) {
                foreach ($response->CurrentInvoice_GetAllResult->CurrentInvoiceHandle as $handle) {
                    $currentInvoice = new CurrentInvoice();
                    $currentInvoice->setHandle((array)$handle);
                    $invoices[$handle->Id] = $currentInvoice;
                }
            }

            return $invoices;
        } catch (\SoapFault $e) {
            throw new Api\Exception\EconomicException($e->getMessage());
        }
    }

    public function getLines(CurrentInvoice $invoice)
    {
        $this->client->connect();
        try{
            $response = $this->client->CurrentInvoice_GetLines(array('currentInvoiceHandle' => $invoice->getHandle()));
            if(!isset($response->CurrentInvoice_GetLinesResult)) {
                throw new Api\Exception\InvoiceNotFoundException(sprintf("Failed fetching current invoice lines"));
            }
            $lines = array();

            if (count($response->CurrentInvoice_GetLinesResult->CurrentInvoiceLineHandle) > 0) {
                $response = $this->client->CurrentInvoiceLine_GetDataArray(array('entityHandles' => $response->CurrentInvoice_GetLinesResult->CurrentInvoiceLineHandle));
                if(!isset($response->CurrentInvoiceLine_GetDataArrayResult)) {
                    throw new Api\Exception\InvoiceNotFoundException(sprintf("Failed fetching current invoice lines"));
                }

                foreach($response->CurrentInvoiceLine_GetDataArrayResult->CurrentInvoiceLineData as $lineData) {
                    $currentInvoiceLine = new CurrentInvoiceLine();
                    $currentInvoiceLine->setHandle((array)$lineData->Handle);
                    $currentInvoiceLine->setQuantity($lineData->Quantity);
                    $currentInvoiceLine->setUnitNetPrice($lineData->UnitNetPrice);
                    $currentInvoiceLine->setDescription($lineData->Description);

                    $lines[$lineData->Number] = $currentInvoiceLine;
                }
            }

            return $lines;
        } catch (\SoapFault $e) {
            throw new Api\Exception\EconomicException($e->getMessage());
        }
    }

    public function delete($invoiceHandle)
    {
        $this->client->connect();

        if ($invoiceHandle instanceof CurrentInvoice) {
            $invoiceHandle = $invoiceHandle->getHandle();
        }

        try {
            $response = $this->client->CurrentInvoice_Delete(array("currentInvoiceHandle" => $invoiceHandle));

            return isset($response->CurrentInvoice_DeleteResult);
        } catch (\SoapFault $e) {
            throw $e;
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
        $lines = array();
        $invoiceLines = $invoice->getLines();
        foreach ( $invoiceLines as $line) {
            $l = $line->toArray();
            if(!isset($l['ProductHandle']['Id'])) {
                $l['ProductHandle']['Id'] = null;
            }
            $lines[] = $l;
        }

        $handles = $this->sendLines($lines);
        foreach($handles as $key=>$handle) {
            $invoiceLines[$key]->setHandle((array)$handle);
        }

        return $invoice;
    }

    private function sendLines($lines)
    {
        $this->client->connect();
        try {
            $response = $this->client->CurrentInvoiceLine_CreateFromDataArray(array("dataArray" => array('CurrentInvoiceLineData' => $lines)));
            if (isset($response->CurrentInvoiceLine_CreateFromDataArrayResult)) {
                $data = $response->CurrentInvoiceLine_CreateFromDataArrayResult->CurrentInvoiceLineHandle;
                return isset($data->Id) ? array($data) : $data;
            }
            var_dump($response);
        } catch (\SoapFault $e) {
            throw $e;
        }
    }
}
