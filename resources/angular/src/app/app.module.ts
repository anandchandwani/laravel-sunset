import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppComponent }  from './app.component';
import { Ng2SmartTableModule } from 'ng2-smart-table';

@NgModule({
  imports:      [ BrowserModule, Ng2SmartTableModule ],
  declarations: [ AppComponent ],
  bootstrap:    [ AppComponent ]
})
export class AppModule { }
