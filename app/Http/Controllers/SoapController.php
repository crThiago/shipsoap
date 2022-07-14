<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;
use App\Services\HelloWorld;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SoapController extends Controller
{
    /**
     * @return void
     */
    public function server()
    {
        try {
            $server = new \SoapServer(route('wsdl'));
            $server->setClass(CompanyService::class);
            $server->handle();
        } catch (SOAPFault $f) {
            info($f->faultstring);
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function wsdl() {
        $wsdlGenerator = new \PHP2WSDL\PHPClass2WSDL(\App\Services\CompanyService::class, route('server'));
        // Generate the WSDL from the class adding only the public methods that have @soap annotation.
        $wsdlGenerator->generateWSDL(true);
        // Dump as string
        $wsdlXML = $wsdlGenerator->dump();

        return response($wsdlXML, 200, ['Content-Type' => 'application/xml']);
    }

    /**
     * @return void
     * @throws \SoapFault
     */
    public function client()
    {
        $client = new \SoapClient(route('wsdl'));

        dd($client->__soapCall("add", array(1, 2)));
    }
}
