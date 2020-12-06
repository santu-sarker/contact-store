
<!-- Modal -->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="./includes/delete_contact.inc.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="delete_id" id="delete_id">
      <h5 class="modal-title" id="exampleModalLabel">Do You Want To Delete This Contact .?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        <form class="" action="./Includes/delete_contact.inc.php" method="POST">
        <button type="submit" name="submit" class="btn btn-success">Yes</button>
        </form>
      </div>
      </form>
    </div>
  </div>
</div>
