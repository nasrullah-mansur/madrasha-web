@extends('back.layout.layout', [$title = 'Appintment Day & Time']) 

@section('content')
<section id="html5">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Appintment Day & Time</h4>
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
                    <a href="{{ route('day.time.create') }}" class="btn btn-primary">Add Day & Time</a>
                </div>
                <table class="table table-bordered mb-0">
                    <thead>
                      <tr>
                        <th>#No</th>
                        <th>Chamber</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Staus</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($dayTimes as $day)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $day->chamber->chamber_name }}</td>
                        <td>{{ $day->day }}</td>
                        <td>{{ $day->time }}</td>
                        <td>
                          <span style="padding: 5px 8px; margin-right: 5px; border-radius: 3px" class="text-white {{ $day->status == STATUS_ACTIVE ? 'bg-success' : 'bg-warning' }}">{{ $day->status }}</span>
                        </td>
                        <td>{{ $day->created_at->diffForHumans() }}</td>
                        <td>{{ $day->updated_at->diffForHumans() }}</td>
                        <td>
                          <div class="d-flex action-btn">
                            <a class="btn btn-icon btn-success" style="margin-right: 5px;" href="{{ route('day.time.edit', $day->id) }}"><i class="ft-edit"></i></a>
                            <a class="btn btn-icon btn-danger delete-data" data-id="{{ $day->id }}" style="margin-right: 5px;" href="#"><i class="ft-trash-2"></i></a> 
                        </div>
                        </td>
                      </tr>

                      @empty
<tr>
                        <td colspan="8">
                            <p class="p-1 text-center">No Data Found</p>
                        </td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




@endsection


@push('db_js')
    
    <script>

        const daysOfWeek = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        const select = $('#add_select');

               

         // Delete Data;
         $('.table').on('click', '.delete-data', function(e) {
             e.preventDefault();
             let deleteRoute = "{{ route('day.time.delete') }}";
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
