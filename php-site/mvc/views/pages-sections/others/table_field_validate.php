<?php if( isAdministrator() || isValidator() || isEditor() ){ ?>
                        <tr>
                          <td colspan="2"
<?php if($validated){ ?>
                              class="validated"
<?php } else { ?>
                              class="notvalidated"
<?php } ?>
                              id="validation">
                            <span class="validatedstatus">
                              Validated
                            </span>
                            <span class="notvalidatedstatus">
                              Not validated
                            </span>
<?php if( isValidator() ){ ?>
                            <a id="unvalidate">(unvalidate)</a>
                            <a id="validate">(validate)</a>
<?php } ?>
                          </td>
                        </tr>
<?php } ?>
