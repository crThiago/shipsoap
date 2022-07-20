import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import { environment } from "../environments/environment";
import {Vehicle} from "./vehicles";

@Injectable({
  providedIn: 'root'
})
export class VehicleService {
  url: string = 'http://shipsoap.test/soap';

  constructor(private http: HttpClient) { }

  getVehicles(companyId: number) {
    const xml: string = `
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soap="http://shipsoap.test/soap">
       <soapenv:Header/>
       <soapenv:Body>
          <soap:getVehicles>
             <company_id>${companyId}</company_id>
          </soap:getVehicles>
       </soapenv:Body>
    </soapenv:Envelope>
    `;

    return this.http.post(environment.urlSoap, xml, {responseType: "text"});
  }

  updateVehicle(vehicle: Vehicle) {
    const xml: string = `
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soap="http://shipsoap.test/soap">
       <soapenv:Header/>
       <soapenv:Body>
          <soap:updateVehicle>
             <id>${vehicle.id}</id>
             <company_id>${vehicle.company_id}</company_id>
             <name>${vehicle.name}</name>
          </soap:updateVehicle>
       </soapenv:Body>
    </soapenv:Envelope>
    `

    return this.http.post(environment.urlSoap, xml, {responseType: "text"});
  }

  removeVehicle(id: number) {
    const xml: string = `
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soap="http://shipsoap.test/soap">
       <soapenv:Header/>
       <soapenv:Body>
          <soap:removeVehicle>
             <id>${id}</id>
          </soap:removeVehicle>
       </soapenv:Body>
    </soapenv:Envelope>
    `;

    return this.http.post(environment.urlSoap, xml, {responseType: "text"});
  }
}
