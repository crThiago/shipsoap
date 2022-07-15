<?php

namespace App\Services;

class SoapService
{
    private $CompanyService;
    private $VehicleService;

    /**
     *
     */
    public function __construct()
    {
        $this->CompanyService = new CompanyService();
        $this->VehicleService = new VehicleService();
    }

    /**
     * Retorna todas as empresas
     *
     * @return string
     */
    public function getCompanies(): string
    {
        return $this->CompanyService->index()->toJson();
    }

    /**
     * Retornar os dados da empresa pelo ID
     *
     * @param int $id
     * @return string
     */
    public function getCompany(int $id): string
    {
        return $this->CompanyService->show($id)->toJson();
    }

    /**
     * Adiciona uma empresa
     *
     * @param string $name
     * @param string $country
     * @return string
     */
    public function addCompany(string $name, string $country): string
    {
        return $this->CompanyService->store(collect(['name' => $name, 'country' => $country]));
    }

    /**
     * Atualiza os dados da empresa pelo ID
     *
     * @param int $id
     * @param string $name
     * @param string $country
     * @return bool
     */
    public function updateCompany(int $id, string $name, string $country): bool
    {
        return $this->CompanyService->update($id, collect(['name' => $name, 'country' => $country]));
    }

    /**
     * Remove uma empresa pelo ID
     *
     * @param int $id
     * @return bool
     */
    public function removeCompany(int $id): bool
    {
        return $this->CompanyService->destroy($id);
    }


    /**
     * Retorna todos os veículos
     *
     * @param int|null $company_id
     * @return string
     */
    public function getVehicles(int $company_id = null): string
    {
        if ($company_id) {
            $this->VehicleService->setCompanyId($company_id);
        }
        return $this->VehicleService->index()->toJson();
    }

    /**
     * Retorna os dados do veículo por ID
     *
     * @param int $id
     * @return string
     */
    public function getVehicle(int $id): string
    {
        return $this->VehicleService->show($id)->toJson();
    }

    /**
     * Adiciona um veículo
     *
     * @param int $company_id
     * @param string $name
     * @return string
     */
    public function addVehicle(int $company_id, string $name): string
    {
        return $this->VehicleService->store(collect(['company_id' => $company_id, 'name' => $name]))->toJson();
    }

    /**
     * Atualiza os dados do veículo pelo ID
     *
     * @param int $id
     * @param int $company_id
     * @param string $name
     * @return bool
     */
    public function updateVehicle(int $id, int $company_id, string $name): bool
    {
        return $this->VehicleService->update($id, collect(['company_id' => $company_id, 'name' => $name]));
    }

    /**
     * Remove um veículo pelo ID
     *
     * @param int $id
     * @return bool
     */
    public function removeVehicle(int $id): bool
    {
        return $this->VehicleService->destroy($id);
    }
}
