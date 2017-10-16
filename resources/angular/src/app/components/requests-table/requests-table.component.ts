import { Component } from '@angular/core';
import { Http } from '@angular/http';
import { DataTableComponent } from '../data-table/data-table.component';
import { ApiService } from '../../api.service';
@Component({
  selector: 'darkcloud-requests-table',
  // templateUrl: '../data-table/data-table.component.html',
  templateUrl: './requests-table.component.html',
  // styleUrls: ['./requests-table.component.css']
})
// export class RequestsTableComponent  {
export class RequestsTableComponent extends DataTableComponent {

  // private apiURL: string = '/darkcloud/api/requests';
  protected apiURL: string = '/darkcloud/api/requests';

  settings = {
    columns: {
      id: {
        title: 'ID',
      },
      ip_id: {
        title: 'IP ID',
      },
      redirected_to: {
        title: 'redirected_to',
      },
      created_at: {
        title: 'created_at',
      },
      updated_at: {
        title: 'updated_at',
      },
    },
  };

  constructor(http: Http, api: ApiService) {
    super(http, api);
    this.loadSources();
   }

}
