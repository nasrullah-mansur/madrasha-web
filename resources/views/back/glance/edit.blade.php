@extends('back.layout.layout', [$title = 'Edit glance'])


@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title" id="basic-layout-square-controls">Edit glance</h4>
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
        <div class="card-body">
          <form class="form" action="{{ route('glance.update') }}" method="POST" >
            @csrf
            <div class="form-body">
              

              <fieldset class="form-group">
                <label for="content">Content</label>
                <textarea id="content" rows="5" class="form-control summernote" name="content" placeholder="content">
                  {{ $glance ? $glance->content : '' }}
                </textarea>
                @if($errors->has('content'))
                <small class="text-danger">{{ $errors->first('content') }}</small>
                @endif
              </fieldset>

              <h4>Create List</h4>
          <fieldset class="form-group contact-repeater">
              <div data-repeater-list="list">

                @if ($glance)
                @foreach (json_decode($glance->list) as $glans)
                <div class="input-group mb-1 border-bottom pb-2" data-repeater-item>
                    <input value="{{ $glans->list_name }}" type="text" placeholder="List Name" class="form-control mr-2" name="list_name" />
                    <input value="{{ $glans->count }}" type="text" placeholder="Count" class="form-control" name="count" />
                    <div class="input-group-append">
                        <span class="input-group-btn" id="button-addon2">
                            <button class="btn btn-danger" type="button" data-repeater-delete><i class="ft-x"></i></button>
                        </span>
                    </div>
                </div>
                @endforeach
                @endif

                <div class="input-group mb-1 border-bottom pb-2" data-repeater-item>
                    <input type="text" placeholder="List Name" class="form-control mr-2" name="list_name" />
                    <input type="text" placeholder="Count" class="form-control" name="count" />
                    <div class="input-group-append">
                        <span class="input-group-btn" id="button-addon2">
                            <button class="btn btn-danger" type="button" data-repeater-delete><i class="ft-x"></i></button>
                        </span>
                    </div>
                </div>

            </div>
            <button type="button" data-repeater-create class="btn btn-primary"><i class="icon-plus4"></i> Add new list item</button>
          </fieldset>

                            
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary" style="margin-right: 5px; ">
                  <i class="fa fa-check-square-o"></i> Save
                </button>
              <button type="reset" class="btn btn-warning">
                <i class="ft-x"></i> Reset
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('custom_js')
  <script src="{{ asset('back/vendors/js/forms/repeater/jquery.repeater.min.js') }}"type="text/javascript"></script>
  <script src="{{ asset('back/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
@endpush