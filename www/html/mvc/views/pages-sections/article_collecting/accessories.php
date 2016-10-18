<?php if(count($accessories)>0){ ?>
                            <tr><th>Accessories</th></tr>
<?php foreach ($accessories as $accessory) { ?>
                            <tr><td>
                              <input type="checkbox" checked
                                      name="collect_accessory_<?= $accessory['accessory_internalid'] ?>"
                                      id="collect_accessory_<?= $accessory['accessory_internalid'] ?>" />
                              <label for="collect_accessory_<?= $accessory['accessory_internalid'] ?>"
                                      collectentry="accessories"
                                      internalid="<?= $accessory['accessory_internalid'] ?>">
                                accessory (<?= $accessory['accessory_internalid'] ?>)
                              </label>
                            </td></tr>
<?php } // foreach ?>
<?php } // if(count( ?>
