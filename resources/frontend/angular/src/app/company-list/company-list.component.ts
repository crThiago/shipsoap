import { Component, OnInit } from '@angular/core';
import { Company } from '../companies';
import { CompanyService } from '../company.service';
import {getResultXML} from "../../assets/functions";

@Component({
  selector: 'app-company-list',
  templateUrl: './company-list.component.html',
  styleUrls: ['./company-list.component.scss']
})
export class CompanyListComponent {
  companies!: Company[]

  constructor(private companiesService: CompanyService ) {
    this.companiesService.getAllCompanies().subscribe((data) => {
      this.companies = getResultXML(data, 'getCompaniesResult');
    })
  }
}
