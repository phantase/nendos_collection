# Ideas I got when offline (and then not able to write tickets in Github)

* Check from time to time when user is connected for new data
* For that, maybe, at each change of the DB (new part, part modification, validation, unvalidation, new image, image modification, part added to image...) modify a (static) file with inside a hash that will be used to know if there is something new, if there is, then the data will be downloaded again
* Then of course, we had to keep this (or these) hash(es) client side to be able to make comparison easily between the current state client side and the state server side.
* If the states are different, we can download again these data
* We can also image than when it's creation, the state change is "MAJOR"; when it's modification, the state change could be "minor"
* And of course, as we manage the parts with different request, we will be able to download only the requested new parts
* So maybe also do something incremental as we have the date of modification of each database record
==> What has been done is that right now we have the possibility to launch an auto-reload (with a user defined time interval between reloads), but right now, this reload retrieves the whole database...

# TODO (also)

* Page to edit (change/add) the user picture, and services server side
* Page to edit an user, and services server side

# Favorites

* See if we let the internalid, maybe it's better to remove it and make the userid+elementid the PK (unique), so we avoid users favorite multiple time the element if they use the API...
