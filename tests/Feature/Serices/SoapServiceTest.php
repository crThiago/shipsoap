<?php

namespace Tests\Feature\Serices;

use App\Models\Company;
use App\Services\CompanyService;
use Tests\TestCase;

class SoapServiceTest extends TestCase
{
    public function test_get_companies()
    {
        $client = new \SoapClient(route('soap_wsdl'), ['cache_wsdl' => WSDL_CACHE_NONE]);

        $result = $client->__soapCall('getCompanies', []);

        $this->assertEquals((new CompanyService())->index()->toJson(), $result->getCompaniesResult);
    }

    public function test_get_company_by_id()
    {
        $client = new \SoapClient(route('soap_wsdl'), ['cache_wsdl' => WSDL_CACHE_NONE]);

        $class = new \stdClass();
        $class->id = rand(1, 4);
        $result = $client->__soapCall('getCompany', [$class]);

        $this->assertEquals((new CompanyService())->show($class->id)->toJson(), $result->getCompanyResult);
    }
}
