@extends('layout')

@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Add Meal</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('meals.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="user_id" class="form-label">User:</label>
                    <select name="user_id" class="form-select" required>
                        <option value="" selected disabled>Select a user</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="meal_count" class="form-label">Meal Count:</label>
                    <input type="number" name="meal_count" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="meal_date" class="form-label">Meal Date:</label>
                    <input type="date" name="meal_date" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Add Meal</button>
            </form>
        </div>
    </div>
</div>

@endsection
