<?php if(count($bodyparts)>0){ ?>
                            <tr><th>Bodyparts</th></tr>
<?php foreach ($bodyparts as $bodypart) { ?>
                            <tr><td>
                              <input type="checkbox" checked
                                      name="collect_bodypart_<?= $bodypart['bodypart_internalid'] ?>"
                                      id="collect_bodypart_<?= $bodypart['bodypart_internalid'] ?>" />
                              <label for="collect_bodypart_<?= $bodypart['bodypart_internalid'] ?>">
                                bodypart (<?= $bodypart['bodypart_internalid'] ?>)
                              </label>
                            </td></tr>
<?php } // foreach ?>
<?php } // if(count( ?>
