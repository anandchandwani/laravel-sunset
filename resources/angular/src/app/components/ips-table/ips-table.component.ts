import { Component } from '@angular/core';
import { Http } from '@angular/http';
import { DataTableComponent } from '../data-table/data-table.component';
import { ApiService } from '../../api.service';

@Component({
  selector: 'darkcloud-ips-table',
  // templateUrl: '../data-table/data-table.component.html',
  templateUrl: './ips-table.component.html',
  // styleUrls: ['./requests-table.component.css']
})
export class IpsTableComponent extends DataTableComponent {

  // protected apiURL: string = '/darkcloud/api/ips';
  protected apiURL: string = '/darkcloud/api/ip';

  settings = {
    columns: {
      id: {
        title: 'ID',
      },
      ip: {
        title: 'IP',
      },
      is_blacklisted: {
        title: 'is_blacklisted',
      },
      redirect_url: {
        title: 'redirect_url',
      },
    },
  };

  constructor(http: Http, api: ApiService) {
    super(http, api);
    this.loadSources();
   }

}
