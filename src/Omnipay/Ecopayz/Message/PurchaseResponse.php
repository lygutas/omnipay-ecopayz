<?php

namespace Omnipay\Ecopayz\Message;

use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Ecopayz Purchase Response
 *
 * @author Alexander Fedra <contact@lygutas.at>
 * @copyright 2015 DerCoder
 * @license http://opensource.org/licenses/mit-license.php MIT
 * @version 2.0.3 Ecopayz API Specification
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $testEndpoint = 'https://secure.test.ecopayz.com/PrivateArea/WithdrawOnlineTransfer.aspx';
    protected $liveEndpoint = 'https://secure.ecopayz.com/PrivateArea/WithdrawOnlineTransfer.aspx';

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->getEndpoint() . '?' . http_build_query($this->data, '', '&');
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return null;
    }

    protected function getEndpoint()
    {
        return $this->getRequest()->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
