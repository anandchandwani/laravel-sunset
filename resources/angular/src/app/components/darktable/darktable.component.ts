import { Component } from '@angular/core';
import { ApiService } from '../../api.service';


@Component({
  selector: 'darktable',
  templateUrl: './darktable.component.html',
  styleUrls: ['./darktable.component.css']
})
export class DarktableComponent {

  // rows = [
  //   { name: 'Austin', gender: 'Male', company: 'Swimlane' },
  //   { name: 'Dany', gender: 'Male', company: 'KFC' },
  //   { name: 'Molly', gender: 'Female', company: 'Burger King' },
  // ];
  // columns = [
  //   { prop: 'name' },
  //   { name: 'Gender' },
  //   { name: 'Company' }
  // ];


  editing = {};
  rows = [];
  private api: ApiService;

  constructor(api: ApiService) {
    this.api = api;

    console.log('Constructor called');
    this.api.getAll().subscribe(data => {
      this.rows = data.json().ips;
      console.log(this.rows);
    })
   }

   /** TODO TODO ! MAKE THIS DO API CALLS, OTHERWISE IT'S JUST CLIENT SIDE */
  updateValue(event, cell, cellValue, row) {
    this.editing[row.$$index + '-' + cell] = false;
    this.rows[row.$$index][cell] = event.target.value;

    console.log(event, cell, cellValue, row);

  }


  ngOnInit() {
  }

}
