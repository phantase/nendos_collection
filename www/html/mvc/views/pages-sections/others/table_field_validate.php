<?php if( isAdministrator() || isValidator() || isEditor() ){ ?>
                        <tr>
<?php if($validated){ ?>
                          <td colspan="<?= ($colspan+1) ?>" class="validated">
                            Validated
<?php if( isValidator() ){ ?>
                            (unvalidate)
<?php } ?>
                          </td>
<?php } else { ?>
                          <td colspan="<?= ($colspan+1) ?>" class="notvalidated">
                            Not validated
<?php if( isValidator() ){ ?>
                            (validate)
<?php } ?>
                          </td>
<?php } ?>
                        </tr>
<?php } ?>
