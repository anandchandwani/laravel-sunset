// import { ServerDataSource } from 'ng2-smart-table'
import { ServerDataSource } from 'ng2-smart-table'


/**
 * https://github.com/akveo/ng2-smart-table/issues/195
 */

export class DarkcloudDataSource extends ServerDataSource {

  public update(element: any, values: any): Promise<any> {
    return new Promise((resolve, reject) => {
        this.find(element).then(found => {
            //Copy the new values into element so we use the same instance
            //in the update call.
            // element.name = values.name;
            // element.enabled = values.enabled;
            // element.condition = values.condition;
            // debugger;

            //ARC - Makes sure it gets all properties, not just explicitly listed ones above.
            Object.keys(values).forEach(key => {
                element[key] = values[key];
            });

            //Don't call super because that will cause problems - instead copy what DataSource.ts does.
            ///super.update(found, values).then(resolve).catch(reject);
            this.emitOnUpdated(element);
            this.emitOnChanged('update');
            resolve();
        }).catch(reject);
    });
  }
  public find(element: any): Promise<any> {
    //Match by the any id
    const found: any = this.data.find(el => el.id === element.id);
     if (found) {
        return Promise.resolve(found);
    }
    return Promise.reject(new Error('Element was not found in the dataset'));
  }

}
