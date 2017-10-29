* [X] ~~*"Listening Only" mode.  Solution: App-based override.*~~

Angular 
* [ ] Create new apps
* [ ] Universal blacklist, share across all apps.
    - Repurpose `is_blacklisted` field, so it's no longer used for IP-based redirect logic.
        - Each campaign can be chosen if it's redirecting to tracking platform or not
        - AND all blacklisted IPs are ALWAYS blacklisted, regardless of campagin status.

If hours are under 15 hours, then just go for it. 


Possible Ideas:
* [ ] Bulk import a CSV of ips (discuss format, how to link to app?)
* [ ] Geo IP lookup in row (use http://www.geoplugin.net/json.gp?ip=182.119.195.28 )
* [ ] Bulk editting of rows (checkbox select).
* [ ] Search in the IPs table, i.e. all blacklisted or none blacklisted.



Required:
???