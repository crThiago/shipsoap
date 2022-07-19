import { Component, OnInit } from '@angular/core';
import { Company } from '../companies';
import { CompanyService } from '../company.service';
@Component({
  selector: 'app-company-list',
  templateUrl: './company-list.component.html',
  styleUrls: ['./company-list.component.scss']
})
export class CompanyListComponent {
  companies!: Company[]

  constructor(private companiesService: CompanyService ) {
    this.companiesService.getAllCompanies().subscribe((data) => {
      const parser = new DOMParser();
      const xml = parser.parseFromString(data, 'text/xml');
      this.companies = JSON.parse(xml.getElementsByTagName('getCompaniesResult')[0].childNodes[0].nodeValue  || '{}')
    })
  }
}
