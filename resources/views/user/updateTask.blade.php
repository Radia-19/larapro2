@extends('masterLayout')

@section('content')

    <div class="row mt-3">
        <div class="col-12">
            @include('errors.error')
            <form class="" action="{{ route('task.update',[$task->id]) }}" method="POST">
                @csrf
                <label for="" class="form-label">Task Title</label>
                <input type="text" name="name" placeholder="Enter Task Name" class="form-control" value="{{ $task->name }}">
                <label for="" class="form-label mt-3">Task Details</label>
                <textarea name="details" id="" placeholder="Enter Task Details"
                          cols="30" rows="10" class="form-control">{{ $task->details }}</textarea>
                <div class="row">
                    <div class="mt-3">
                        <button type="submit" class="btn btn-info w-100" name="submit" value="Create">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
