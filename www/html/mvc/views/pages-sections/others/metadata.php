              <div class="row">
                <div class="12$">
                  <h4>Metadata</h4>
                  <div class="table-wrapper">
                    <table>
                      <tbody>
                        <tr><th>Created by</th><td><?= $metadata['creator_name'] ?> (<?= intervalFormater($metadata['creation_diff']) ?> ago)</td></tr>
                        <!--<tr><th>Created by</th><td><?= $metadata['creator_name'] ?> (<abbr title="<?= $metadata['creation'] ?>"><?= intervalFormater($metadata['creation_diff']) ?> ago</abbr>)</td></tr>-->
                        <tr><th>Edited by</th><td><?= $metadata['editor_name'] ?> (<?= intervalFormater($metadata['edition_diff']) ?> ago)</td></tr>
                        <!--<tr><th>Edited by</th><td><?= $metadata['editor_name'] ?> (<abbr title="<?= $metadata['edition'] ?>"><?= intervalFormater($metadata['edition_diff']) ?> ago</abbr>)</td></tr>-->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
