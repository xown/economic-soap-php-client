<?php


namespace Economic;


use Economic\Api\Configuration;
use Economic\Api\Debtor\DebtorService;
use Economic\Api\Exception\AuthenticationException;
use Economic\Api\Invoice\CurrentInvoiceService;
use Economic\Api\Product\ProductService;

class Client
{
    /** @var \SoapClient */
    static private $wsdl;
    private $config;
    private $connected = false;
    private $connectionToken;
    private $instances = array();

    public function __construct(Configuration $config)
    {
        $this->config = $config;

        if ($config->autoStart) {
            $this->start();
        }
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->getClient(), $name), $arguments);
    }

    public function connect()
    {
        if ($this->connected && $this->connectionToken) {
            return $this;
        }
        try {
            $response              = $this->getClient()->connectWithToken(array("token" => $this->config->token, "appToken" => $this->config->appToken));
            $this->connectionToken = $response->ConnectWithTokenResult;
            $this->connected       = true;
        } catch (\SoapFault $e) {
            throw new AuthenticationException($e->getMessage(), $e->getCode());
        }

        return $this;
    }

    public function getClient()
    {
        if (self::$wsdl === null) {
            $this->start();
        }

        return self::$wsdl;
    }

    public function getConfiguration()
    {
        return $this->config;
    }

    /**
     * @return DebtorService
     */
    public function getDebtorService()
    {
        if (!isset($this->instances["debtor"])) {
            $this->instances["debtor"] = new DebtorService($this);
        }

        return $this->instances["debtor"];
    }

    /**
     * @return ProductService
     */
    public function getProductService()
    {
        if (!isset($this->instances["product"])) {
            $this->instances["product"] = new ProductService($this);
        }

        return $this->instances["product"];
    }

    public function getCurrentInvoiceService()
    {
        if (!isset($this->instances["current_invoice"])) {
            $this->instances["current_invoice"] = new CurrentInvoiceService($this);
        }

        return $this->instances["current_invoice"];
    }

    public function reset(Configuration $configuration = null)
    {
        unset(self::$wsdl);
        $this->connected       = false;
        $this->connectionToken = false;
        if ($configuration !== null) {
            $this->config = $configuration;
        }
    }

    protected function start()
    {
        $this->connected = false;
        $cacheFile       = Configuration::CACHE_DIR . "/" . Configuration::CACHE_FILE;

        if (!file_exists($cacheFile) || filemtime($cacheFile) < time() - (24 * 3600 * 30)) {
            file_put_contents($cacheFile, file_get_contents(Configuration::WSDL_URL));
        }
        if (self::$wsdl === null) {
            self::$wsdl = new \SoapClient($cacheFile, array("trace" => true, "exception" => true, "cache" => WSDL_CACHE_DISK));
        }
    }
}
