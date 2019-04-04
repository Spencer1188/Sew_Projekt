<link href="asserts/css/bootstrap.css" rel="stylesheet" type="text/css">
<div class="modal fade" id="myModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Anpassen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       	<div class="row justify-content-md-center">
				<fieldset class="col col-lg-10">
					<legend>Titel</legend>
					<input id="update_in" type="text" class="form-control">
				</fieldset>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="safe_changes()" data-dismiss="modal">Änderungen speichern</button>
      </div>
    </div>
  </div>
</div>