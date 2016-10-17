<?php if(count($hairs)>0){ ?>
                            <tr><th>Hairs</th></tr>
<?php foreach ($hairs as $hair) { ?>
                            <tr><td>
                              <input type="checkbox" checked
                                      name="collect_hair_<?= $hair['hair_internalid'] ?>"
                                      id="collect_hair_<?= $hair['hair_internalid'] ?>" />
                              <label for="collect_hair_<?= $hair['hair_internalid'] ?>">
                                hair (<?= $hair['hair_internalid'] ?>)
                              </label>
                            </td></tr>
<?php } // foreach ?>
<?php } // if(count( ?>
