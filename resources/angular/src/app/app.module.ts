import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { Ng2SmartTableModule } from 'ng2-smart-table';
import { DataTableComponent } from './components/data-table/data-table.component';
import { RequestsTableComponent } from './components/requests-table/requests-table.component';
import { IpsTableComponent } from './components/ips-table/ips-table.component';
import { ApiService } from './api.service';
import {HttpClientModule} from '@angular/common/http';

import { NgxDatatableModule } from '@swimlane/ngx-datatable';


@NgModule({
  declarations: [
    AppComponent,
    DataTableComponent,
    RequestsTableComponent,
    IpsTableComponent
  ],
  imports: [
    BrowserModule,
    Ng2SmartTableModule,
    HttpClientModule,
    NgxDatatableModule
  ],
  providers: [ApiService],
  bootstrap: [AppComponent]
})
export class AppModule { }
