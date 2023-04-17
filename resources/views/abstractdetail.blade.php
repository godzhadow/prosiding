@extends('layouts.base')

@section('content')
<div class="container">
    {{-- <div class="row mb-5">
        <div class="col-md-12"> --}}
            <a href="/"> <i class="fa fa-arrow-alt-left"></i></a>
        {{-- </div>
    </div> --}}
    @foreach ($paper as $p)
        <div class="row mb-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h5>{{$p->title}}</h5>
                                <p>{{$p->team}}</p>
                                <p>{{$p->year}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <iframe id="pdf" src="{{url($p->abstract)}}" frameBorder="0" scrolling="no" style="height: 90vh" width="100%">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
