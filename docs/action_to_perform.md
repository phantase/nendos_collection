## Change name of images to have their number in the name [2018-07-29]

We have actually only one picture per part, the goal is to have multiple one, for that, we need, before adding the function, to change the name of the picture to take this new feature in account.

`1_full.jpg` will become `1_1_full.jpg`.

To do that automatically, we will change in the DB the field `haspicture` which is a `tinyint` (`boolean`) to a `int` that will count the picture, the advantage is that for part without picture it's already 0 and for other parts it's already 1.

Then we need to apply the following script for each type of part (*accessories*, *bodyparts*, *boxes*, *faces*, *hairs*, *hands*, *nendoroids*).

`for f in *_full.jpg; do mv $f "${f%_full.jpg}_1_full.jpg"; done`
and
`for f in *_thumb.jpg; do mv $f "${f%_thumb.jpg}_1_thumb.jpg"; done`

Change in DB `haspicture` from `tinyint` to `int`, and rename it to `nbpictures`.