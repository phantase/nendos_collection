<?php if(count($nendoroids)>0){ ?>
                            <tr><th>Nendoroids</th></tr>
<?php foreach ($nendoroids as $nendoroid) { ?>
                            <tr><td>
                              <input type="checkbox" checked
                                      name="collect_nendoroid_<?= $nendoroid['nendoroid_internalid'] ?>"
                                      id="collect_nendoroid_<?= $nendoroid['nendoroid_internalid'] ?>" />
                              <label for="collect_nendoroid_<?= $nendoroid['nendoroid_internalid'] ?>">
                                <?= $nendoroid['nendoroid_name'] ?>
                              </label>
                            </td></tr>
<?php } // foreach ?>
<?php } // if(count( ?>
