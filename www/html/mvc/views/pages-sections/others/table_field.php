                        <tr>
                          <th style="width:40%;">
                            <?= $label ?>
<?php if(canEdit()) { ?>
                            <i class="icon fa-edit atright field_edit" title="Edit field" field="<?= $field ?>"></i>
                            <i class="icon fa-check atright field_valid" title="Save field" field="<?= $field ?>" style="display:none;"></i>
<?php } ?>
                          </th>
                          <td>
<?php if(canEdit()) { ?>
                            <input type="text" value="<?= $value ?>" field="<?= $field ?>" style="display:none;" placeholder="<?= $label ?>" />
<?php } ?>
                            <span field="<?= $field ?>">
                              <?= $value ?>&nbsp;
                            </span>
                          </td>
                        </tr>
