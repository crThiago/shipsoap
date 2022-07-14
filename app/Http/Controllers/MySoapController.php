<?php

namespace App\Http\Controllers;

use App\Soap\Person;
use App\Soap\SoapDemoServer;
use Illuminate\Http\Request;
use KDuma\SoapServer\AbstractSoapServerController;

class MySoapController extends AbstractSoapServerController
{
    protected function getService(): string
    {
        return SoapDemoServer::class;
    }

    protected function getEndpoint(): string
    {
        return route('my_soap_server');
    }

    protected function getWsdlUri(): string
    {
        return route('my_soap_server.wsdl');
    }

    protected function getClassmap(): array
    {
        return [
            'SoapPerson' => Person::class,
        ];
    }
}
