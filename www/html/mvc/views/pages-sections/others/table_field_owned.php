<?php if(isLogged()){ ?>
                        <tr>
                          <td colspan="2" class="owned_infos">
<?php if(isset($additiondate)){ ?>
                            <span>
                              <span>Owned</span> (added <?= intervalFormater($additionsince) ?>)
                            </span>
<?php } else { ?>
                            <span>
                              <a>Add to my collection</a>
                            </span>
<?php } ?>
                          </td>
                        </tr>
<?php } ?>
