<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CompanyService
{
    public function index(): Collection
    {
        return Company::all();
    }

    public function show(int $id): Company
    {
        return Company::findOrFail($id);
    }

    public function store(Collection $collection): Company
    {
        return Company::create($collection->only(['name', 'country'])->toArray());
    }

    public function update(int $id, Collection $collection): bool
    {
        return Company::where('id', $id)->update($collection->only(['name', 'country'])->toArray());
    }

    public function destroy(int $id): bool
    {
        return Company::where('id', $id)->delete();
    }
}
