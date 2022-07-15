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
     * @return string
     */
    public function getCompanies(): string
    {
        return $this->_company->index()->toJson();
    }

    /**
     * Retornar os dados da empresa pelo ID
     *
     * @param int $id
     * @return string
     */
    public function getCompany(int $id): string
    {
        return $this->_company->show($id)->toJson();
    }
}
