<div class="modal fade in modal-3d-flip-horizontal modal-info" id="CreateGradeLeaveTypeModal" aria-hidden="true" aria-labelledby="CreateGradeLeaveTypeModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header" >
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="training_title">Create Grade Leave Type Length</h4>
            </div>
            <form class="form-horizontal" id="CreateGradeLeaveTypeForm"  method="POST">
                <div class="modal-body">

                    @csrf
                    <div class="form-group">
                        <label for=""> Grade </label>
                        <select name="grade_id" id="" class="form-control" required>
                            @foreach($grades as $grade)
                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for=""> Leave Type</label>
                        <select name="leave_type_id" class="form-control" id="" required>
                            @foreach($leave_types as $leave_type)
                                <option value="{{$leave_type->id}}">{{$leave_type->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for=""> Length</label>
                        <input type="number" class="form-control" id="length" name="length" placeholder="" required>

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
