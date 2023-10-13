<div class="modal fade" id="approveLeaveRequestModal" aria-hidden="true"
     aria-labelledby="approveLeaveRequestModal" role="document" tabindex="-1">
    <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approve Leave Request</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <form  id="approveLeaveRequestForm" enctype="multipart/form-data">
                <div class="modal-body">

                    @csrf

                    <div class="form-group">
                        <label for="">Approve/Reject</label>
                        <select class="form-control" id="approval" name="approval" data-allow-clear="true">
                            <option> -- Select Option -- </option>
                            <option value="1">Approve</option>
                            <option value="2">Reject</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Comment</label>
                        <textarea class="form-control" id="comment" name="comments" style="height: 100px;resize: none;"
                                  placeholder="Comment"></textarea>
                    </div>
                    <input type="hidden" name="type" value="save_approval">
                    <input type="hidden" name="leave_approval_id" id="approval_id">

                </div>
                <div class="modal-footer">
                    <div class="col-xs-12">

                        <div class="form-group">

                            <button type="submit" class="btn btn-info pull-left">Approve/Reject</button>
                            <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                        </div>
                        <!-- End Example Textarea -->
                    </div>
                </div>
                </form>
            </div>

    </div>
</div>
