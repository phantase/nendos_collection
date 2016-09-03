              <div class="row">
                <div class="12$">
                  <h4>Metadata</h4>
                  <div class="table-wrapper">
                    <table>
                      <tbody>
                        <tr><th>Created by</th><td><?= $metadata['db_creatorname'] ?> (<?= intervalFormater($metadata['db_creationdiff']) ?>)</td></tr>
                        <tr><th>Edited by</th><td><?= $metadata['db_editorname'] ?> (<?= intervalFormater($metadata['db_editiondiff']) ?>)</td></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
