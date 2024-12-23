@extends('masterLayout')

@section('content')


    <div class="row mt-3">
        <div class="col-12">

            @if(session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
            @endif

            @foreach($allTasks as $task)
             {{-- <div class="card text-bg-light @if($task->status == 'pending')text-bg-light @else bg-info @endif mb-3"> --}}
                <div class="card text-black @if($task->status == 'pending') bg-light @else bg-info @endif mb-3">
                    <div class="card-header">
                     Task ID: {{ $task->id }}
                     <div class="float-end">

                        @if($task->status == 'pending')
                            <a class="btn btn-info btn-sm me-2" href="{{ route('task.updateStatus',[$task->id,'complete']) }}">Mark as complete</a>
                        @else
                            <a class="btn btn-danger btn-sm me-2" href="{{ route('task.updateStatus',[$task->id,'pending']) }}">Back to pending</a>
                        @endif
                        <a class="text-info-emphasis ms-2 me-2" href="{{ route('task.show',[$task->id]) }}">Edit</a>
                        <a class="text-danger " onclick="return confirm('Are you sure?')" href="{{ route('task.delete',[$task->id]) }}">Delete</a>
                     </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $task->name }}</h5>
                        <p class="card-text">{{ $task->details }}</p>
                    </div>
                </div>
            @endforeach

            {{ $allTasks->links() }}

        </div>
    </div>


@endsection
