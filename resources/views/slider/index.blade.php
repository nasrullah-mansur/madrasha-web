@extends('back.layout.layout', [$title = 'All sliders', $add_btn = 'Add new slider', $add_btn_link = route('slider.create')])

@section('content')
<section id="html5">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">All Sliders</h4>
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
               <table class="table">
                 <tr>
                    <td>#</td>
                    <td>Image</td>
                    <td>Action</td>
                </tr>

                @foreach ($sliders as $slider)
                   <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset($slider->image) }}" alt="alt" style="width: 100px;">
                        </td>
                        <td>
                            <div class="d-flex action-btn">
                                <a class="btn btn-icon btn-success" style="margin-right: 5px;" href="{{ route('slider.edit', $slider->id) }}"><i class="ft-edit"></i></a>
                                <a data-id="{{ $slider->id }}" class="btn btn-icon btn-danger delete-data" style="margin-right: 5px;" href="#"><i class="ft-trash-2"></i></a> 
                            </div>
                        </td>
                    </tr> 
                @endforeach
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
        
         // Delete Data;
         $('.table').on('click', '.delete-data', function(e) {
             e.preventDefault();
             let deleteRoute = "{{ route('slider.delete') }}";
                 let delteteDataId = $(this).attr("data-id");
                 console.log(delteteDataId);
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
                             success: function(response){
                              swal({
                                        icon: "success",
                                        title: "Deleted!",
                                        text: "Your imaginary file has been deleted.",
                                        showConfirmButton: true,
                                        closeModal: false,
                                    });
        
                                    location.reload()
                                 
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
     
     </script>
@endpush