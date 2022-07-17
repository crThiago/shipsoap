import { Component, OnInit } from '@angular/core';
import { companies } from '../companies';

@Component({
  selector: 'app-company-list',
  templateUrl: './company-list.component.html',
  styleUrls: ['./company-list.component.scss']
})
export class CompanyListComponent implements OnInit {
  companies = companies;

  constructor() { }

  ngOnInit(): void {
  }

}
