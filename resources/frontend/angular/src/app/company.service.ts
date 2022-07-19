import { Injectable } from '@angular/core';
import { Company, companies } from './companies';
import { HttpClient } from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class CompanyService {
  companies: Company[] = [];
  url: string = 'http://shipsoap.test/soap';

  constructor(private http: HttpClient) {}

  getAllCompanies() {
    const xml: string = `
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soap="http://shipsoap.test/soap">
       <soapenv:Header/>
       <soapenv:Body>
          <soap:getCompanies/>
       </soapenv:Body>
    </soapenv:Envelope>`;

    return this.http.post(this.url, xml,{responseType: "text"});
  }
}
