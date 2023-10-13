<div class="modal fade in modal-3d-flip-horizontal modal-info" id="CreateHolidayModal" aria-hidden="true" aria-labelledby="CreateHolidayModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header" >
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="training_title">Create  Leave Type </h4>
            </div>
            <form class="form-horizontal" id="CreateHolidayForm"  method="POST">
                <div class="modal-body">

                    @csrf
                    <div class="form-group">
                        <label for="">  Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="" required>

                    </div>

                    <div class="form-group">
                        <label for=""> Date</label>
                        <input type="number" class="form-control" id="date" name="date" placeholder="" required>

                    </div>


                    </div>




                <div class="modal-footer">
                    <div class="col-xs-12">

                        <div class="form-group">

                            <button type="submit" class="btn btn-info pull-left">Save</button>
                            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <!-- End Example Textarea -->
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
