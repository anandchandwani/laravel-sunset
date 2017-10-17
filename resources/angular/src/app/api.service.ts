import { Injectable } from '@angular/core';
import { Http } from '@angular/http';

@Injectable()
export class ApiService {
  private http: Http;

  constructor(http: Http) {
    this.http = http;
  }

  /** Currently only updates requests. Should extend so url is passed by component too as it already has it. */
  update(apiURL, body) {
    this.http.patch(`${apiURL}/${body.id}`, body)
    .subscribe(response => {
      console.log('Update response', response);
    })
  }

  getAll(){
    return this.http.get('/darkcloud/json')
  }

}
