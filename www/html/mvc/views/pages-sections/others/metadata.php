              <div class="row">
                <div class="12u$">
                  <h4 id="toggle_metadata"><a>Metadata (<span>show</span><span style="display:none;">hide</span>)</a></h4>
                  <div class="table-wrapper" style="display:none;">
                    <table>
                      <tbody>
                        <tr><th>Created by</th><td><?= $metadata['db_creatorname'] ?> (<?= intervalFormater($metadata['db_creationdiff']) ?>)</td></tr>
                        <tr><th>Edited by</th><td><?= $metadata['db_editorname'] ?> (<?= intervalFormater($metadata['db_editiondiff']) ?>)</td></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
