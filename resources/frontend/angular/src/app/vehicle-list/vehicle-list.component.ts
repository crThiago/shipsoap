import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { Vehicle } from '../vehicles';
import { VehicleService } from "../vehicle.service";
import { getResultXML } from "../../assets/functions";
import {Company} from "../companies";
import {CompanyService} from "../company.service";

@Component({
  selector: 'app-vehicle-list',
  templateUrl: './vehicle-list.component.html',
  styleUrls: ['./vehicle-list.component.scss']
})
export class VehicleListComponent {
  form = {
    name: ''
  };
  vehicles!: Vehicle[];
  companies!: Company[];
  companyId: number;
  editVehicle: Vehicle | undefined;

  constructor(
    private route: ActivatedRoute,
    private vehicleService: VehicleService,
    private companyService: CompanyService
  ) {
    this.companyId = Number(this.route.snapshot.paramMap.get('companyId'));
    this.vehicleService.getVehicles(this.companyId)
      .subscribe((data) => {
        this.vehicles = getResultXML(data, 'getVehiclesResult');
      })

    this.companyService.getAllCompanies()
      .subscribe((data) => {
        this.companies = getResultXML(data, 'getCompaniesResult');
      })
  }

  create() {
    this.vehicleService.addVehicle(this.form.name, this.companyId)
      .subscribe((data) => {
        this.vehicles.push(getResultXML(data, 'addVehicleResult'));
      });
  }

  update(vehicle: Vehicle) {
    this.vehicleService.updateVehicle(vehicle).subscribe((data) => {
      if (getResultXML(data, 'updateVehicleResult')) {
        this.vehicles = this.vehicles.filter((vehicle) => vehicle.company_id == this.companyId);
      }
    });
    this.editVehicle = undefined;
  }

  delete(id: number) {
    this.vehicleService.removeVehicle(id).subscribe((data) => {
      if (getResultXML(data, 'removeVehicleResult')) {
        this.vehicles = this.vehicles.filter((vehicle) =>  vehicle.id != id);
      }
    });
  }
}
