import {Component, EventEmitter, OnInit, Output} from '@angular/core';
import {CompanyService} from "../company.service";
import {Company} from "../companies";
import {getResultXML} from "../../assets/functions";

@Component({
  selector: 'app-company-create',
  templateUrl: './company-create.component.html',
  styleUrls: ['./company-create.component.scss']
})
export class CompanyCreateComponent {
  name: string = '';
  country: string = '';
  @Output() addCompany = new EventEmitter<Company>();

  constructor(private companyService: CompanyService) { }

  create() {
    this.companyService.addCompany(this.name, this.country).subscribe((data) => {
      this.addCompany.emit(getResultXML(data, 'addCompanyResult'));
    });
    this.name = '';
    this.country = '';
  }
}
