* [ ] Need ability to toggle whether it's in "listening only" mode. This should be app specific setting.  No redirects will happen then. (Alternative implementation: be able to set all redirects to any value you want regardless of redirect value, then just set the redirect_url to null. More flexible this way)

Angular backend
* [ ] Ability to edit all fields in a row
* [ ] Ability to search "All found IPs", ones that aren't whitelisted/blacklisted
    - Could just be a date-time search?
    - Annoyingly, x-editable treats 'null' as '0' for frontend, so we'd need to modify the db from boolean to something else to get it to work on that table.
* [ ] Put app in 'listen only' mode.
* [ ] Create apps page


PERFORMANCE:

If perfomance is an issue, setup and use queues (redis). https://lumen.laravel.com/docs/5.1/queues