@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <ul id="tasks" class="sortable">
                    @foreach($tasks as $task)
                    <li class="" data-task-id="{{ $task->id }}">{{ $task->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src ="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let url = "{{ route('tasks.sort') }}"

        $('#tasks').sortable({
            connectWith: ".sortable",
            receive: (e, ui) => {
                let task = $(ui.item).data("task-id")

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {id: task},
                    success: function (response) {
                        console.log("Set as priority 1", response.data)
                    }
                })
            }
        }).disableSelection();
    });
</script>
@endpush

@push('styles')
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
          rel = "stylesheet">
@endpush
