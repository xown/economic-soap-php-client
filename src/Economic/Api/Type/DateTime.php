<?php


namespace Economic\Api\Type;


class DateTime implements TypeInterface
{
    private $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function toXSD()
    {
        if ($this->date instanceof \DateTime) {
            return $this->date->format("c");
        }

        return date("c", strtotime($this->date));
    }
}
