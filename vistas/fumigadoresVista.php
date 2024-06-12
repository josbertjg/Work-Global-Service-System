<!DOCTYPE html>
<html lang="en">
  <?php $components->head(true); ?>
<body>

  <?php $components->header(true) ?>
 
  <main class="container-fluid height-adjustment d-flex justify-content-center"> 
    <div class="row container">
      <div class="col-1 d-flex justify-content-end align-items-start pt-5">
        <a href="/">
          <i class="fa-solid fa-arrow-left goBack"></i>
        </a>
      </div>
      <div class="col-11 fumigadores-list-wrapper pt-3">
        <div class="fumigadores-list-container"></div>
      </div>
    </div>
  </main>

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/fumigadores.js"></script>
</body>

</html>