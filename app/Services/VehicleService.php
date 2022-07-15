<?php

namespace App\Services;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class VehicleService
{
    private $company_id;

    public function index()
    {
        return Vehicle::where(function (Builder $query) {
            if ($this->company_id) {
                $query->where('company_id', $this->company_id);
            }
        })->get();
    }

    public function show(int $id)
    {
        return Vehicle::findOrFail($id);
    }

    public function store(Collection $collection)
    {
        return Vehicle::create($collection->only(['name', 'company_id'])->toArray());
    }

    public function update(int $id, Collection $collection)
    {
        return Vehicle::where('id', $id)->update($collection->only(['name', 'company_id'])->toArray());
    }

    public function destroy(int $id)
    {
        return Vehicle::where('id', $id)->delete();
    }

    public function setCompanyId(int $id)
    {
        $this->company_id = $id;
    }
}
