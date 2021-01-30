<div class="modal fade bs-example-modal-lg" id="photoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Gallery System Library</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-9">
          <div class="thumbnails row">
            <?php
            $photos = Photo::findAllRows();
            foreach ($photos as $photo) {
            ?>

              <div class="col-xs-2">
                <a role="checkbox" aria-checked="false" tabindex="0" id="" href="#" class="thumbnail" style="outline: none;">
                  <img class="modal_thumbnails img-responsive" src="<?php echo $photo->getDisplayPath() ?>" data-id="<?php echo $photo->id ?>" alt="<?php echo $photo->title ?>">
                </a>
              </div>

            <?php
            }
            ?>

          </div>
        </div>
        <!--col-md-9 -->

        <div class="col-md-3">
          <div id="modal_sidebar"></div>
        </div>

      </div>
      <!--Modal Body-->
      <div class="modal-footer">
        <div class="row">
          <!--Closes Modal-->
          <button id="set_user_image" type="button" class="btn btn-primary" disabled="true" data-dismiss="modal">Apply Selection</button>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->