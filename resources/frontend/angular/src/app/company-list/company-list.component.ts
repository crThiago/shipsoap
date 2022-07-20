import { Component, Input, OnInit } from '@angular/core';
import { Company } from '../companies';
import { CompanyService } from '../company.service';
import {getResultXML} from "../../assets/functions";

@Component({
  selector: 'app-company-list',
  templateUrl: './company-list.component.html',
  styleUrls: ['./company-list.component.scss']
})
export class CompanyListComponent {
  companies!: Company[];
  editCompany: Company | undefined;

  constructor(private companiesService: CompanyService ) {
    this.companiesService.getAllCompanies().subscribe((data) => {
      this.companies = getResultXML(data, 'getCompaniesResult');
    })
  }

  addCompany(company: Company) {
    this.companies.push(company);
  }

  update(company: Company) {
    this.companiesService.updateCompany(company).subscribe();
    this.editCompany = undefined
  }

  delete(companyId: number) {
    this.companiesService.removeCompany(companyId).subscribe((data) => {
      if (getResultXML(data, 'removeCompanyResult')) {
        this.companies = this.companies.filter((company) => company.id != companyId)
      }
    })
  }

  enableEdit() {

  }
}
