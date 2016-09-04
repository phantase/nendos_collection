<?php if( canEdit() || isset($value) ) { ?>
                        <tr>
                          <th>
                            <?= $label ?>
<?php if(canEdit()) { ?>
                            <i class="icon fa-edit atright field_edit" title="Edit field" field="<?= $field ?>"></i>
                            <i class="icon fa-check atright field_valid" title="Save field" field="<?= $field ?>" style="display:none;"></i>
<?php } ?>
                          </th>
                          <td colspan="<?= $colspan ?>">
<?php if(canEdit()) { ?>
                            <input type="text" value="<?= $link ?>" field="<?= $field ?>" style="display:none;" />
<?php } ?>
                            <span field="<?= $field ?>">
                              <a href="<?= $link ?>" target="_blank">
                                <?= $value ?>
                              </a>
                            </span>
                          </td>
                        </tr>
<?php } ?>
