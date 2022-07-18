import { Component, OnInit } from '@angular/core';
import { Company } from '../companies';
import { CompanyService } from '../company.service';
@Component({
  selector: 'app-company-list',
  templateUrl: './company-list.component.html',
  styleUrls: ['./company-list.component.scss']
})
export class CompanyListComponent implements OnInit {
  companies!: Company[]

  constructor(private companiesService: CompanyService ) { }

  ngOnInit(): void {
    this.companies = this.companiesService.getAllCompanies();
  }

}
