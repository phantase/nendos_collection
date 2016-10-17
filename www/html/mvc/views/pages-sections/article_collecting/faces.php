<?php if(count($faces)>0){ ?>
                            <tr><th>Faces</th></tr>
<?php foreach ($faces as $face) { ?>
                            <tr><td>
                              <input type="checkbox" checked
                                      name="collect_face_<?= $face['face_internalid'] ?>"
                                      id="collect_face_<?= $face['face_internalid'] ?>" />
                              <label for="collect_face_<?= $face['face_internalid'] ?>">
                                Face (<?= $face['face_internalid'] ?>)
                              </label>
                            </td></tr>
<?php } // foreach ?>
<?php } // if(count( ?>
