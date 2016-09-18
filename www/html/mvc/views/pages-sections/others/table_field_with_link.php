<?php if( isEditor() || isset($value) ) { ?>
                        <tr>
                          <th>
                            <?= $label ?>
<?php if(isEditor()) { ?>
                            <i class="icon fa-edit atright field_edit" title="Edit field" field="<?= $field ?>"></i>
                            <i class="icon fa-check atright field_valid" title="Save field" field="<?= $field ?>" style="display:none;"></i>
<?php } ?>
                          </th>
                          <td>
<?php if(isEditor()) { ?>
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
