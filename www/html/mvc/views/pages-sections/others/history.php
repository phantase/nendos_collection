              <div class="row">
                <div class="12$">
                  <h4>History</h4>
                  <div class="table-wrapper">
                    <table>
                      <tbody>
<?php foreach ($history as $key => $histentry) { ?>
                        <tr>
                          <td>
                            <?= $histentry['history_actionlabel'] ?>
                            <i><?= $histentry['history_user_name'] ?></i>
                            <?= intervalFormater($histentry['history_actioninterval']) ?>
                          </td>
                        </tr>
<?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
