@extends('back.layout.layout', [$title = 'Create new add']);


@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title" id="basic-layout-square-controls">Create new add</h4>
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
          <form class="form" action="{{ route('advertizement.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-body">


              <fieldset class="form-group">
                <div class="image-preview hide" >
                    <img style="max-width: 120px;" src="{{ asset('back/images/gallery/1.jpg') }}" alt="image">
                </div>
                <label for="basicInputFile">Choose Image</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input image-input-show" id="image" name="image">
                  <label class="custom-file-label" for="image">Choose file</label>
                </div>
                @if($errors->has('image'))
                <small class="text-danger">{{ $errors->first('image') }}</small>
                @endif
              </fieldset>

              <div class="form-group">
                <label for="name">Title</label>
                <input type="text" id="name" class="form-control square {{ $errors->has('title') ? 'is-invalid' : ''}} " placeholder="Title" name="title">
                @if ($errors->has('title'))
                    <small class="text-danger">{{ $errors->first('title') }}</small>
                @endif
              </div>

              <div class="form-group">
                <label for="link">Link</label>
                <input type="text" id="link" class="form-control square {{ $errors->has('link') ? 'is-invalid' : ''}} " placeholder="Link" name="link">
                @if ($errors->has('link'))
                    <small class="text-danger">{{ $errors->first('link') }}</small>
                @endif
              </div>

              <div class="form-group">
                <label>Select Position</label>
                <select class="form-control" name="position">
                    <option value="blog-page">Blog Page</option>
                    <option value="single-blog-page">Single Blog Page</option>
                    <option value="chamber-page">Chambers Page</option>
                </select>
                @if ($errors->has('position'))
                    <small class="text-danger">{{ $errors->first('position') }}</small>
                @endif
              </div>

              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="{{ STATUS_ACTIVE }}">Public</option>
                    <option value="{{ STATUS_INACTIVE }}">Save Draft</option>
                </select>
              </div>

              
                            
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary" style="margin-right: 5px; ">
                  <i class="fa fa-check-square-o"></i> Save
                </button>
              <button type="button" type="reset" class="btn btn-warning">
                <i class="ft-x"></i> Reset
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection