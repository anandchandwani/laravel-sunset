import { Component, OnInit } from '@angular/core';
import { Http } from '@angular/http';
// import { ServerDataSource } from 'ng2-smart-table'
import { DarkcloudDataSource } from './darkcloud-data-source';
import { ApiService } from '../../api.service';

@Component({
  selector: 'darkcloud-data-table',
  templateUrl: './data-table.component.html',
  styleUrls: ['./data-table.component.css']
})
export class DataTableComponent implements OnInit {
  private source: DarkcloudDataSource;
  protected apiURL: string;
  private http: Http;
  private api: ApiService;

  settings: any = {
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
    this.http = http;
    this.api = api;
    // this.loadSources();
    // console.log('calling constructor with', this.apiURL, this.constructor.name)

    // this.source = new DarkcloudDataSource(http, {
    //   endPoint: this.apiURL
    // });

    // this.source.onChanged().subscribe(changed => {
    //   console.log('source onChanged', changed);
    // })

    // this.source.onUpdated().subscribe(updated => {
    //   console.log('source updated', updated);
    // })
  }

  loadSources() {
    console.log(`${this.constructor.name} with API: ${this.apiURL}`);
    this.source = new DarkcloudDataSource(this.http, {
      endPoint: this.apiURL
    });

    // this.source.onChanged().subscribe(changed => {
    //   console.log('source onChanged', changed);
    // })

    this.source.onUpdated().subscribe(updated => {
      console.log('source updated', updated);
      this.api.update(this.apiURL, updated);
    })
  }

  ngOnInit() {
  }

}
