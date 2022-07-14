<?php

namespace App\Services;

class SoapService
{
    private $_company;

    /**
     *
     */
    public function __construct()
    {
        $this->_company = new CompanyService();
    }

    /**
     * Retorna todas as empresas
     *
     * @return array
     */
    public function getCompanies(): array
    {
        return $this->_company->index()->toArray();
    }

    /**
     * Retornar os dados da empresa pelo ID
     *
     * @param int $id
     * @return array
     */
    public function getCompany(int $id): array
    {
        return $this->_company->show($id)->toArray();
    }
}
