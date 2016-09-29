# nendos_collection

Simple web application to manage a Nendoroid collection.

It allows:
* Adding to the global DB
  * Adding boxes (i.e. what you buy in shops)
  * Adding nendoroids (i.e. the full figurine with all its parts, but remember that we can have multiple figurines in one box)
  * Adding parts (i.e. single parts of the figurine, of the box, like faces, bodies, accessories, arms, ...)
* Adding to a user DB (i.e. its collection)
  * Any element (i.e. boxe, nendoroid or part)
  * A picture where an element is present, that will be used to illustrate how we can use this element

The available roles to this DB are:
* Administrator
> They can do anything \o/

* Validator
> They can validate elements entered by editors so other users can view them

* Editor
> They can add new elements to the system

* Standard user
> They can view elements that are in the DB and add them to their own collection

* Not authentified user
> They can view elements that are in the DB (and they can register to have their own collection ^_^ )
