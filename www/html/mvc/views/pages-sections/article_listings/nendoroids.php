              <section class="tiles">
<?php
foreach ($nendoroids as $nendoroid) {
?>
                <style>
                  .tiles article#nendo_<?= $nendoroid['nendoroid_internalid'] ?> > .image:before {
                    background-color: #<?= $nendoroid['nendoroid_dominant_color'] ?>;
                  }
                </style>
                <article id="nendo_<?= $nendoroid['nendoroid_internalid'] ?>">
                  <span class="image fit">
                    <img src="images/nendos/nendoroids/<?= $nendoroid['nendoroid_internalid'] ?>_thumb" alt="" />
                  </span>
                  <a href="nendoroid/<?= $nendoroid['nendoroid_internalid'] ?>/<?= $nendoroid['nendoroid_url'] ?>/">
                    <h2>
<?php if($nendoroid['box_number']){ ?>
                      #<?= $nendoroid['box_number'] ?><br/>
<?php } ?>
                      <?= $nendoroid['nendoroid_name'] ?>
                    </h2>
                    <div class="content">
                      <p>
                        <?= $nendoroid['box_series'] ?>
                        <br/>
                        <?= $nendoroid['box_name'] ?>
                        <br/>
                        <?= $nendoroid['box_category'] ?> (<?= $nendoroid['box_manufacturer'] ?>)
                      </p>
                    </div>
                  </a>
                </article>
<?php
}
?>
              </section>
