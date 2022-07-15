<?php

namespace App\Http\Controllers;

use App\Services\SoapService;
use KDuma\SoapServer\AbstractSoapServerController;

class SoapController extends AbstractSoapServerController
{
    protected function getService(): string
    {
        return SoapService::class;
    }

    protected function getEndpoint(): string
    {
        return route('soap_server');
    }

    protected function getWsdlUri(): string
    {
        return route('soap_wsdl');
    }

    protected function getClassmap(): array
    {
        return [
            //
        ];
    }
}
