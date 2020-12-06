
<!-- Modal -->
<div class="modal fade text-center" id="contact_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel">Add A New Contact </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-signin" action="./includes/add_contact.inc.php" method="POST" autocomplete="on">
      <div class="card-body justify-content-center">
        <div class="row">
        <input type="hidden" name="contact_id" id="contact_id">
          <input type="name" name="contact_name" id="contact_name" class="form-control col-lg-12 col-md-12 col-sm-12 col-12  " placeholder="Enter Contact Name" required autofocus>


        </div>
        <div class="row my-3">

          <input type="number" name="contact_number" id="contact_number" class="form-control col-12 "  placeholder="Enter Contact Number" required autofocus>

        </div>
        <div class="row my-3">

          <input type="email" name="contact_email" id="contact_email" class="form-control col-12 "  placeholder="Enter Contact Email Adress" required autofocus>

        </div>
        <input type="hidden" name="update_contact" id="update_contact" value="false">

      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit" id="submit" name="submit" >Add Contact</button>
    </form>

      </div>
    </div>
  </div>
</div>
