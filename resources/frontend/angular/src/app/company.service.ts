import { Injectable } from '@angular/core';
import { Company, companies } from './companies';


@Injectable({
  providedIn: 'root'
})
export class CompanyService {
  companies: Company[] = companies;

  getAllCompanies(): Company[] {
    return this.companies;
  }
}
