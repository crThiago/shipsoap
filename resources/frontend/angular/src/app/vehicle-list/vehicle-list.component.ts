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

  constructor(
    private route: ActivatedRoute,
    private vehicleService: VehicleService
  ) {
    let companyId = this.route.snapshot.paramMap.get('companyId');
    this.vehicleService.getVehicles(Number(companyId))
      .subscribe((data) => {
        this.vehicles = getResultXML(data, 'getVehiclesResult');
      })
  }
}
