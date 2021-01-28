<?php include("includes/header.php"); ?>

<?php
if (isset($_GET['page']) && isset($_GET['items'])) {
  $currentPage = (int)$_GET['page'];
  $itemsPerPage = (int)$_GET['items'];
  $itemsTotalCount = Photo::totalCount();
  $pagination = new Paginate($currentPage, $itemsPerPage, $itemsTotalCount);
  $photos = $pagination->findItems();
}
?>

<div class="row">

  <!-- Blog Entries Column -->
  <div class="col-md-12">
    <?php

    foreach ($photos as $photo) {
    ?>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="photo.php?id=<?php echo $photo->id ?>">
          <img src="<?php echo $photo->getDisplayPath() ?>" alt="<?php echo $photo->title ?>" class="img-thumbnail" style="height: 150px; width: 200px; object-fit: cover;margin-bottom: 20px;">
        </a>
      </div>
    <?php
    }
    ?>
  </div>
</div>
<!-- /.row -->


<div class="row">
  <div class="col-lg-12">
    <ul class="pager">
      <?php if ($pagination->hasPrevious()) echo "<li><a href='index.php?page={$pagination->previous()}&items={$pagination->itemsPerPage}'>Previous</a></li>" ?>
      <?php
      for ($i = 1; $i <= $pagination->totalPages(); $i++) {
      ?>
        <li>
          <a href="<?php echo "index.php?page={$i}&items={$pagination->itemsPerPage}" ?>" <?php if ($pagination->currentPage === $i) echo "style='background-color: #bbb; color: #22a;'" ?>><?php echo $i ?></a>
        </li>
      <?php
      }
      ?>
      <?php if ($pagination->hasNext()) echo "<li><a href='index.php?page={$pagination->next()}&items={$pagination->itemsPerPage}'>Next</a></li>" ?>
    </ul>
  </div>
</div>


<?php include("includes/footer.php"); ?>