http://104.236.158.9/darkcloud

* [X] ~~*"Listening Only" mode.  Solution: App-based override.*~~
* [X] ~~*Create new apps*~~
* [X] ~~*Universal blacklist, share across all apps.*~~
    - [X] ~~*Repurpose `is_blacklisted` field, so it's no longer used for IP-based redirect logic.*~~
        - [X] ~~*Each campaign can be chosen if it's redirecting to tracking platform or not*~~
        - [X] ~~*AND all blacklisted IPs are ALWAYS blacklisted, regardless of campagin status.*~~
* [X] ~~*Listen to get request "appName" param to get app*~~

If hours are under 15 hours, then just go for it. 


Possible Ideas:
* [ ] Bulk import a CSV of ips (discuss format, how to link to app?)
* [ ] Geo IP lookup in row (use http://www.geoplugin.net/json.gp?ip=182.119.195.28 )
* [ ] Bulk editting of rows (checkbox select).
* [ ] Search in the IPs table, i.e. all blacklisted or none blacklisted.


BUGS:

* [ ] The "appName" redirect for different apps isn't working
    - http://104.236.158.9/?appName=test isn't redirecting to reddit but it should.
* [ ] Will never redirect first request. Is this an issue?
    - Idea: Just return the "default_blacklist / redirect_app" value?


