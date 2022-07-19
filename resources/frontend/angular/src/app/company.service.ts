import { Injectable } from '@angular/core';
import { Company, companies } from './companies';
import { HttpClient } from "@angular/common/http";
import { environment } from "../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class CompanyService {
  companies: Company[] = [];

  constructor(private http: HttpClient) {}

  getAllCompanies() {
    const xml: string = `
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soap="http://shipsoap.test/soap">
       <soapenv:Header/>
       <soapenv:Body>
          <soap:getCompanies/>
       </soapenv:Body>
    </soapenv:Envelope>`;

    return this.http.post(environment.urlSoap, xml,{responseType: "text"});
  }

  removeCompany(id: number) {
    const xml: string = `
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soap="http://shipsoap.test/soap">
       <soapenv:Header/>
       <soapenv:Body>
          <soap:removeCompany>
            <id>${id}</id>
          </soap:removeCompany>
       </soapenv:Body>
    </soapenv:Envelope>`;

    return this.http.post(environment.urlSoap, xml,{responseType: "text"});
  }
}
