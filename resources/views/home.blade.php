@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form id="projects_form" class="form" method="GET" action="{{ route('tasks.view', ['id' => 1]) }}">
                        @csrf
                        <label for="projects">Select Project</label>
                        <select class="form-control" id="projects">
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ $project->id ==1 'selected': ''}}>{{ $project->name }} </option>
                        @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">View Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts') 
<script>
    $(document).ready(function() {
        let form = $('#projects_form');
        let url = "{{ $url }}"

        form.on('submit', function(e) {
            e.preventDefault();

            url = url + '/' + $('#projects option:selected').val()

            window.location.href = url;
        })
    });
</script>
@endpush
