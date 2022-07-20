import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { Vehicle } from '../vehicles';
import { VehicleService } from "../vehicle.service";
import { getResultXML } from "../../assets/functions";

@Component({
  selector: 'app-vehicle-list',
  templateUrl: './vehicle-list.component.html',
  styleUrls: ['./vehicle-list.component.scss']
})
export class VehicleListComponent {
  vehicles!: Vehicle[];
  companyId: number;
  editVehicle: Vehicle | undefined;

  constructor(
    private route: ActivatedRoute,
    private vehicleService: VehicleService
  ) {
    this.companyId = Number(this.route.snapshot.paramMap.get('companyId'));
    this.vehicleService.getVehicles(this.companyId)
      .subscribe((data) => {
        this.vehicles = getResultXML(data, 'getVehiclesResult');
      })
  }

  update(vehicle: Vehicle) {
    this.vehicleService.updateVehicle(vehicle).subscribe((data) => {
      if (getResultXML(data, 'updateVehicleResult')) {
        this.vehicles = this.vehicles.filter((vehicle) => vehicle.company_id == this.companyId)
      }
    });
    this.editVehicle = undefined;
  }

  delete(id: number) {
    this.vehicleService.removeVehicle(id).subscribe((data) => {
      if (getResultXML(data, 'removeVehicleResult')) {
        this.vehicles = this.vehicles.filter((vehicle) =>  vehicle.id != id)
      }
    })
  }
}
