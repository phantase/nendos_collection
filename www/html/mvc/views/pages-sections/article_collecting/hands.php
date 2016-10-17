<?php if(count($hands)>0){ ?>
                            <tr><th>Hands</th></tr>
<?php foreach ($hands as $hand) { ?>
                            <tr><td>
                              <input type="checkbox" checked
                                      name="collect_hand_<?= $hand['hand_internalid'] ?>"
                                      id="collect_hand_<?= $hand['hand_internalid'] ?>" />
                              <label for="collect_hand_<?= $hand['hand_internalid'] ?>">
                                hand (<?= $hand['hand_internalid'] ?>)
                              </label>
                            </td></tr>
<?php } // foreach ?>
<?php } // if(count( ?>
