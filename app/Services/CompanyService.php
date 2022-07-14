<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyService
{
    public function index(): Collection
    {
        return Company::all();
    }

    public function show(int $id): Company
    {
        return Company::find($id);
    }
//
//    public function store(Collection $collection)
//    {
//        return Company::create($collection->only(['name', 'country']));
//    }
}
