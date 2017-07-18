# Ideas I got when offline and specifically about the Search functionnality

We talk here only of search without the use of ElasticLunR.js or any other js library made for search in js objects...

## Search grammar

### Simple one term search

*term* will search in the whole attributes (used) for the *term*, with expand.

i.e. if I search for *mik*, I will find both **miku** and **mikoto** because they contain *mik*.
The problem is that if I search for *male*, I will also receive the **female** because they contain *male*.

### Simple multiple terms search

*term1 term2 term3*, the idea is to search for the terms in the attributes (used), the question is: do we search with an **OR**, an **AND** ? is the order of terms has an impact on the ranking? (i.e. if we search for *Hatsune Miku*, the element with a single attribute with **Hatsune Miku** inside can have better ranking than the one with **Miku Hatsune** inside...) Also, if *term1* is in an attribute and *term2* in another attribute, with a **AND**, is it a result ? and with a **OR** will this result be higher ranked than a one with only one term ? and another one with the terms in a single attribute will have a better rank ?

## Ranking

The question is: do we do ranking?

If no, no more question...

If yes, we need to define rules for that.
Of course the ranking is dependant of the grammar used.


## Search grammar (BIS)

*term1*

*term1 term2* ==> *term1 __OR__ term2*

*term1 OR term2*

*term1 AND term2*

*NOT term1*

*term1 OR term2 AND term3* ==> *term1 OR (term2 AND term3)*

*attr1:term1 attr2:term2*

*attr1:(term1 term2)**
