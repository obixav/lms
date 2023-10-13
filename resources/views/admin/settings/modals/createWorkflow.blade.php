<div class="modal fade in modal-3d-flip-horizontal modal-info" id="CreateWorkflowModal" aria-hidden="true" aria-labelledby="CreateWorkflowModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header" >
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="training_title">Create Workflow</h4>
            </div>
            <form class="form-horizontal" id="CreateWorkflowForm"  method="POST">
                <div class="modal-body">

                    @csrf
                    <div class="form-group">
                        <label for=""> Work Flow Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                        @endif
                    </div>
                    <div class="card">    <div class="card-inner">
                        <ul id="stgcont">

                    </ul>
                        </div>
                    </div>
                    <button type="button" id="addStage" name="button" class="btn btn-primary">New Stage</button>





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
