@extends('layouts.base')

@section('content')
<div class="container">

    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible alert-block" role="alert" style="top: 50%">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif

    <div class="row justify-content-center mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ url('/addabstract') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row justify-content-center mb-3">
                            <label for="title" class="col-md-3 col-form-label">{{ __('title') }}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }} text-uppercase" name="title" value="{{ old('title') }}" aria-describedby="titleHelp" required autofocus>
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mb-3">
                            <label for="authors" class="col-md-3 col-form-label">{{ __('authors') }}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control{{ $errors->has('authors') ? ' is-invalid' : '' }}" name="authors" value="{{ old('authors') }}" aria-describedby="authorsHelp" required autofocus>
                                @if ($errors->has('authors'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('authors') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mb-3">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="status" class="col-md-3 col-form-label">Year</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" name="year" value="{{ old('year') }}" aria-describedby="yearHelp" required autofocus>
                                        @if ($errors->has('year'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('year') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="country" class="col-md-3 col-form-label">Country</label>
                                    <div class="col-md-9">
                                        <select class="nice-select wide" name="country" required autofocus>
                                            <option value='' selected disabled>country</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Philipine">Philipine</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="file" class="dropify" name="abstract" data-allowed-file-extensions="pdf" data-max-file-size="10240K">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @foreach ($paper as $p)
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>{{$p->title}}</h6>
                            <p>{{$p->team}}</p>
                            <p>{{$p->year}}</p>
                        </div>
                        <div class="col-md-3">
                            @if ($p->preview !=null)
                                <img width="150px" src="{{ url($p->preview) }}">
                            @else
                                <i class="fa fa-file-pdf fa-3x text-danger"></i>
                            @endif
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editAbstract" data-bs-id="{{$p->id}}" data-bs-title="{{$p->title}}" data-bs-team="{{$p->team}}" data-bs-year="{{$p->year}}" data-bs-country="{{$p->country}}" data-bs-picture="{{asset($p->picture)}}"><i class="fa fa-pencil"></i></button>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" href="/deleteabstract/{{ $p->id }}"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
{{-- modal edit abstract --}}
<div class="modal fade" id="editAbstract" tabindex="-1" aria-labelledby="editAbstract" aria-hidden="true">
    <div class="modal-dialog">
        <form name="modal_edit_abstract" id="modal_edit_abstract" action="/editabstract" method="post" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit abstract</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control text-uppercase" name="title" id="title" placeholder="title" required disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label for="author">Team</label>
                        <input type="text" class="form-control" name="team" id="team" placeholder="author" required disabled>
                    </div>
                    <div class="form-group row justify-content-center mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="year">Year</label>
                                <input type="number" class="form-control" name="year" id="year" placeholder="year" required>
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-md-3 col-form-label">Country</label>
                                <div class="col-md-9">
                                    <select class="nice-select wide" name="country" required autofocus>
                                        <option value='' selected disabled>country</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Philipine">Philipine</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{-- <label>Photo abstract (optional)</label> --}}
                                <input type="file" class="dropifyabstract" name="photo_abstract" data-allowed-file-extensions="pdf" data-max-file-size="10240K">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- end modal edit abstract --}}
<script>
    // edit abstract model
    var editAbstractModal = document.getElementById('editAbstract')
    editAbstractModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var id = button.getAttribute('data-bs-id')
        var title = button.getAttribute('data-bs-title')
        var team = button.getAttribute('data-bs-team')
        var year = button.getAttribute('data-bs-year')
        var country = button.getAttribute('data-bs-country')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var inputId = editAbstractModal.querySelector('.modal-body input[name="id"]')
        inputId.value = id
        var inputTitle = editAbstractModal.querySelector('.modal-body input[name="title"]')
        inputTitle.value = title
        var inputTeam = editAbstractModal.querySelector('.modal-body input[name="team"]')
        inputTeam.value = team
        var inputYear = editAbstractModal.querySelector('.modal-body input[name="year"]')
        inputYear.value = year
        var inputCountry = editAbstractModal.querySelector('.modal-body select[name="country"]')
        inputCountry.value = country
        var inputCountry2 = editAbstractModal.querySelectorAll('.modal span.current')[0]
        inputCountry2.innerHTML = country
    })
</script>
@endsection
