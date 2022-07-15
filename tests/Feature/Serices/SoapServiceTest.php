<?php

namespace Tests\Feature\Serices;

use App\Models\Company;
use App\Services\CompanyService;
use Tests\TestCase;

class SoapServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new \SoapClient(route('soap_wsdl'), ['cache_wsdl' => WSDL_CACHE_NONE]);
    }

    public function test_get_companies()
    {
        $result = $this->client->__soapCall('getCompanies', []);

        $this->assertEquals((new CompanyService())->index()->toJson(), $result->getCompaniesResult);
    }

    public function test_get_company_by_id()
    {
        $class = new \stdClass();
        $class->id = rand(1, 4);
        $result = $this->client->__soapCall('getCompany', [$class]);

        $this->assertEquals((new CompanyService())->show($class->id)->toJson(), $result->getCompanyResult);
    }

    public function test_add_company()
    {
        $class = new \stdClass();
        $class->name = fake()->company;
        $class->country = fake()->randomElement(['EUA', 'Russia', 'China']);
        $result = json_decode($this->client->__soapCall('addCompany', [$class])->addCompanyResult);

        $this->assertDatabaseHas(
            'companies',
            [
                'id' => $result->id,
                'name' => $class->name,
                'country' => $class->country
            ]
        );
    }

    public function test_update_company_by_id()
    {
        $company = Company::factory()->create();

        $class = new \stdClass();
        $class->id = $company->id;
        $class->name = fake()->company;
        $class->country = fake()->randomElement(['EUA', 'Russia', 'China']);
        json_decode($this->client->__soapCall('updateCompany', [$class])->updateCompanyResult);

        $this->assertDatabaseHas(
            'companies',
            [
                'id' => $company->id,
                'name' => $class->name,
                'country' => $class->country
            ]
        );
    }

    public function test_remove_company_by_id()
    {
        $company = Company::factory()->create();

        $class = new \stdClass();
        $class->id = $company->id;
        $this->assertTrue($this->client->__soapCall('removeCompany', [$class])->removeCompanyResult);
    }
}
