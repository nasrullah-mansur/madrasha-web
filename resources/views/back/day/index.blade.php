@extends('back.layout.layout', [$title = 'Appintment Days']) 

@section('content')
<section id="html5">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Appintment Days</h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                <li><a data-action="close"><i class="ft-x"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="card-content collapse show">
              <div class="card-body card-dashboard table-responsive">
                <div class="pb-1 text-right">
                    <a href="#" data-toggle="modal" data-target="#add_item" class="btn btn-primary">Add Day</a>
                </div>
                <table class="table table-bordered mb-0">
                    <thead>
                      <tr>
                        <th>#No</th>
                        <th>Title</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($days as $day)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $day->day }}</td>
                        <td>{{ $day->created_at->diffForHumans() }}</td>
                        <td>{{ $day->updated_at->diffForHumans() }}</td>
                        <td>
                          <div class="d-flex action-btn">
                            <a data-id="{{ $day->id }}" data-title="{{ $day->day }}" data-toggle="modal" data-target="#edit_item" class="btn btn-icon btn-success edit-btn" style="margin-right: 5px;" href="#"><i class="ft-edit"></i></a>
                            <a data-id="{{ $day->id }}"  class="btn btn-icon btn-danger delete-data" style="margin-right: 5px;" href="#"><i class="ft-trash-2"></i></a> 
                        </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Add ITEM MODEL -->
<div class="modal fade text-left" id="add_item" tabindex="-1" role="dialog" aria-labelledby="add_item_area" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header bg-primary white">
            <h3 class="modal-title" id="add_item_area"> Add New Day</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="data-form" method="POST" action="{{ route('dr.day.store') }}">
            @csrf
            <div class="modal-body">

                <div class="form-group">
                <label class="d-block">Select Chamber</label>
                <select id="add_select" class="select2 form-control w-100" name="day">
                    
                </select>
                @if ($errors->has('day'))
                    <small class="text-danger">{{ $errors->first('day') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label class="d-block">Select Day</label>
                <select id="add_select" class="select2 form-control w-100" name="day">
                    
                </select>
                @if ($errors->has('day'))
                    <small class="text-danger">{{ $errors->first('day') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label class="d-block">Select Time</label>
                <input type="text" id="chamber_name" class="form-control square  " placeholder="Chamber Name" name="chamber_name">
                @if ($errors->has('time'))
                    <small class="text-danger">{{ $errors->first('time') }}</small>
                @endif
            </div>

            
            
            <br>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-outline-primary add-item">Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Add ITEM MODEL -->


<!-- Edit ITEM MODEL -->
<div class="modal fade text-left" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="edit_item_area" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header bg-primary white">
            <h3 class="modal-title" id="edit_item_area"> Update Day</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="data-form" method="POST" action="{{ route('dr.day.update') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="d-block">Select Day</label>
                    <select id="edit_select" class="select2 form-control w-100" name="day">
                        
                    </select>
                    @if ($errors->has('day'))
                        <small class="text-danger">{{ $errors->first('day') }}</small>
                    @endif
                  </div>
                  <input type="hidden" name="id" id="id">
            
            <br>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-outline-primary add-item">Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>



@endsection


@push('db_js')
    
    <script>

        const daysOfWeek = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        const select = $('#add_select');

               

         // Delete Data;
         $('.table').on('click', '.delete-data', function(e) {
             e.preventDefault();
             let deleteRoute = "{{ route('dr.day.delete') }}";
                 let delteteDataId = $(this).attr("data-id");
                 swal({
                     title: "Are you sure?",
                     text: "You will not be able to recover this imaginary item!",
                     icon: "warning",
                     showCancelButton: true,
                     buttons: {
                         cancel: {
                             text: "No, cancel please!",
                             value: null,
                             visible: true,
                             className: "btn-warning",
                             closeModal: false,
                         },
                         confirm: {
                             text: "Yes, delete it!",
                             value: true,
                             visible: true,
                             className: "",
                             closeModal: false,
                         },
                     },
                 }).then((isConfirm) => {
                     if (isConfirm) {
                         $.ajax({
                             type: "POST",
                             url: deleteRoute,
                             data: {
                                 id: delteteDataId,
                             },
                             success: function(){
                                 swal({
                                     icon: "success",
                                     title: "Deleted!",
                                     text: "The menu removed successfully.",
                                     showConfirmButton: true,
                                     closeModal: false,
                                 });
                                 
                                 $('.table').load(' .table');
                             }
                         });
                     } else {
                         swal({
                             icon: "error",
                             title: "Cancelled!",
                             text: "Your imaginary file is safe :",
                             timer: 2000,
                             showConfirmButton: true,
                         });
                     }
                 });
         });


         // Edit;
        $('.table').on('click', '.edit-btn', function(e) {
            e.preventDefault();

            const select = $('#edit_select');
            select.html('')

            
            let id = $(this).attr("data-id");
            let title = $(this).attr("data-title");
            
            $('#title').val(title);
            $('#id').val(id);

            daysOfWeek.forEach((elem, index) => {
                let option = `<option ${title == elem ? 'selected' : ''} value="${elem}">${elem}</option>`;
                select.append(option);
            });
            

        })
     </script>
@endpush
