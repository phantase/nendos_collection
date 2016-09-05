<?php if( canEdit() || isset($value) ) { ?>
                        <tr>
                          <th style="width:40%;">
                            <?= $label ?>
<?php if(canEdit()) { ?>
                            <i class="icon fa-edit atright field_edit" title="Edit field" field="<?= $field ?>"></i>
                            <i class="icon fa-check atright field_valid" title="Save field" field="<?= $field ?>" style="display:none;"></i>
<?php } ?>
                          </th>
                          <td colspan="<?= $colspan ?>">
<?php if(canEdit()) { ?>
                            <input type="color" value="#<?= $value ?>" field="<?= $field ?>" style="display:none;" placeholder="<?= $label ?>" />
<?php } ?>
                            <span field="<?= $field ?>">
                              <div class="color_field_box" style="background-color:#<?= $value ?>" title="Color: #<?= $value ?>"></div>
                            </span>
                          </td>
                        </tr>
<?php } ?>
