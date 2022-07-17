import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { vehicles } from '../vehicles';

@Component({
  selector: 'app-vehicle-list',
  templateUrl: './vehicle-list.component.html',
  styleUrls: ['./vehicle-list.component.scss']
})
export class VehicleListComponent implements OnInit {
  vehicles = vehicles

  constructor(
    private route: ActivatedRoute
  ) { }

  ngOnInit(): void {
    let companyId = this.route.snapshot.paramMap.get('companyId');
    this.vehicles = this.vehicles.filter((vehicle) => vehicle.company_id === Number(companyId))
  }
}
