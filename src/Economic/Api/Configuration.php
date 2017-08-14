<?php


namespace Economic\Api;


class Configuration
{
    const WSDL_URL   = "https://api.e-conomic.com/secure/api1/EconomicWebService.asmx?WSDL";
    const CACHE_DIR = __DIR__;
    const CACHE_FILE = "wsdl_cache.wsdl";
    public $token;
    public $appToken;
    public $autoStart = false;
}
