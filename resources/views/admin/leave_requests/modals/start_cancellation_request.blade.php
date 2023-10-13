<div class="modal fade" id="startCancellationModal" aria-hidden="true"
     aria-labelledby="startCancellationModal" role="document" tabindex="-1">
    <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancel Leave Request</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <form  id="startCancellationForm" enctype="multipart/form-data">
                <div class="modal-body">

                    @csrf


                    <div class="form-group">
                        <label for="">Reason</label>
                        <textarea class="form-control" id="reason" name="reason" style="height: 100px;resize: none;"
                                  placeholder="Comment"></textarea>
                    </div>
                    <input type="hidden" name="leave_request_id" id="cancel_id">

                </div>
                <div class="modal-footer">
                    <div class="col-xs-12">

                        <div class="form-group">

                            <button type="submit" class="btn btn-info pull-left">Initiate Cancellation</button>
                            <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                        </div>
                        <!-- End Example Textarea -->
                    </div>
                </div>
                </form>
            </div>

    </div>
</div>
