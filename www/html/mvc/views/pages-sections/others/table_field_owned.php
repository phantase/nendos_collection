<?php if(isLogged()){ ?>
                        <tr>
                          <td colspan="2"
<?php if(isset($additiondate)){ ?>
                          class="owned_infos owned"
<?php } else { ?>
                          class="owned_infos notowned"
<?php } ?>
                            id="collection">
                            <span class="ownedstatus">
<?php if(isset($additiondate)){ ?>
                              <span>Owned</span> (added <?= intervalFormater($additionsince) ?>)
<?php } else { ?>
                              <span>Owned</span> (added right now)
<?php } ?>
                              <a id="uncollect">Remove from my collection</a>
                            </span>
                            <span class="notownedstatus">
                              <a id="collect">Add to my collection</a>
                            </span>
                          </td>
                        </tr>
<?php } ?>
