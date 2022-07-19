import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { Vehicle } from '../vehicles';
import { VehicleService } from "../vehicle.service";

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
        const parser = new DOMParser();
        const xml = parser.parseFromString(data, 'text/xml');
        this.vehicles = JSON.parse(xml.getElementsByTagName('getVehiclesResult')[0].childNodes[0].nodeValue  || '{}')
      })
  }
}
