@extends('back.layout.layout', [$title = 'Customize menu items']) 
@section('content')

<div id="custom-menu">
    <div class="content-wrapper">
        
        <div class="content-body menu-builder">
            <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <!-- Main menu update -->
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('menu.update', $menu->id) }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-12 label-control">Menu name</label>
                                    <div class="col-12">
                                        <input name="label" type="text" class="form-control {{ $errors->has('label') ? 'is-invalid' : '' }}" placeholder="CSS Class" value="{{ $menu->label }}"/>
                                        @if($errors->has('label'))
                                        <small class="text-danger"> - {{ $errors->first('label') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 label-control">Menu status</label>
                                    <div class="col-12">
                                        <select class="form-control" name="status">
                                            <option {{ $menu->status == STATUS_ACTIVE ? 'selected' : '' }} value="{{ STATUS_ACTIVE }}">Active</option>
                                            <option {{ $menu->status == STATUS_INACTIVE ? 'selected' : '' }} value="{{ STATUS_INACTIVE }}">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                    <!-- Menu Sidebar -->
                    @include('back.menu.menu_sidebar')
                </div>

                <div class="col-lg-9 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="border-bottom pb-1 mb-2 text-bold-600">Menu Structure</h4>
                            <div class="dd pb-3">

                                <!-- Menu List -->
                                @include('back.menu.menu_list')
                               
                            </div>
                            

                            <div class="border-top mt-3 pt-3">
                                <button type="button" class="set-menu-location btn btn-primary">Save Menu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('menu_js')
<script>

    $('.set-menu-location').on('click', function(e) {
        e.preventDefault();
       let allLiData = setMenuLocation("{{ $menu_id }}");
        $.ajax({
            type: "POST",
            url: "{{ route('menuItem.update') }}",
            data: {data: allLiData},
            success: function (data) {
                toastr.success("Menu successfully updated!", "WELL DONE");
            },
            error: function (error) {
                if (error.statusText) {
                    toastr.warning("Something wrong! please reload the page", "Sorry"); 
                }
            },
        });
    })
    
</script>
@endpush



