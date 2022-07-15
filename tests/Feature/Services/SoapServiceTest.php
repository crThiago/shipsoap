<?php

namespace Tests\Feature\Services;

use App\Models\Company;
use App\Models\Vehicle;
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
        $this->assertDatabaseMissing('companies', ['id' => $class->id]);
    }

    public function test_get_vehicles_by_company_id()
    {
        $class = new \stdClass();
        $class->company_id = 1;

        $this->assertEquals(
            Vehicle::where('company_id', $class->company_id)->get()->toJson(),
            $this->client->__soapCall('getVehicles', [$class])->getVehiclesResult
        );
    }

    public function test_get_all_vehicles()
    {
        $this->assertEquals(
            Vehicle::all()->toJson(),
            $this->client->__soapCall('getVehicles', [])->getVehiclesResult
        );
    }

    public function test_get_vehicle_by_id()
    {
        $class = new \stdClass();
        $class->id = rand(1, 4);

        $this->assertEquals(
            Vehicle::find($class->id)->toJson(),
            $this->client->__soapCall('getVehicle', [$class])->getVehicleResult
        );
    }

    public function test_add_vehicle()
    {
        $class = new \stdClass();
        $class->company_id = rand(1, 4);
        $class->name = fake()->name;

        $result = json_decode($this->client->__soapCall('addVehicle', [$class])->addVehicleResult);

        $this->assertDatabaseHas(
            'vehicles',
            [
                'id' => $result->id,
                'company_id' => $result->company_id,
                'name' => $result->name,
            ]
        );
    }

    public function test_update_vehicle_by_id()
    {
        $vehicle = Vehicle::factory()->create();

        $class = new \stdClass();
        $class->id = $vehicle->id;
        $class->company_id = rand(1, 4);
        $class->name = fake()->name;

        $this->assertTrue($this->client->__soapCall('updateVehicle', [$class])->updateVehicleResult);
        $this->assertDatabaseHas(
            'vehicles',
            [
                'id' => $class->id,
                'company_id' => $class->company_id,
                'name' => $class->name,
            ]
        );
    }

    public function test_destroy_vehicle_by_id()
    {
        $vehicle = Vehicle::factory()->create();
        $class = new \stdClass();
        $class->id = $vehicle->id;

        $this->assertTrue($this->client->__soapCall('removeVehicle', [$class])->removeVehicleResult);
        $this->assertDatabaseMissing('vehicles', ['id' => $class->id]);
    }
}
