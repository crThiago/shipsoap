<?php

namespace App\Services;

class SoapService
{
    private $CompanyService;

    /**
     *
     */
    public function __construct()
    {
        $this->CompanyService = new CompanyService();
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
}
