<?php


namespace Economic\Api\Invoice;


use Economic\Api\Collection;
use Economic\Api\Exception\EconomicException;

class InvoiceCollection extends Collection
{
    public function add($data)
    {
        if(!$data instanceof Invoice ) {
            throw new EconomicException("Invalid data supplied to collection");
        }
        $this->data[] = $data;
    }

}
