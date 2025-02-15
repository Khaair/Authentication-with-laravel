@extends('layout')

@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header pt-5 pb-5">
            <h3>Bazar Cost List</h3>
            <!-- Add Meal Button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMealModal">
                Add Cost
            </button>
        </div>

        <div class="card-body">
            <form action="{{ route('meals.index') }}" method="GET" class="mb-4 row">
                <div class="col-md-4">
                    <label for="month" class="form-label">Month:</label>
                    <input type="number" name="month" min="1" max="12" value="{{ $month }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="year" class="form-label">Year:</label>
                    <input type="number" name="year" value="{{ $year }}" class="form-control">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            <!-- Meal Table -->
            <table class="table border table-hover table-striped table-bordered mt-5">
                <thead class="bg-primary p-3">
                    <tr>
                        <th class="p-3 font-weight-bold">Name</th>
                        <th class="p-3 font-weight-bold">Title</th>
                        <th class="p-3 font-weight-bold" scope="col">Date</th>
                        <th class="p-3 font-weight-bold" scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($costs as $item)
                    <tr>
                        <td class="p-3">{{ $item->user->name }}</td>
                        <td class="p-3">{{ $item->title }}</td>
                        <td class="p-3">{{ $item->cost_date }}</td>
                        <td class="p-3">{{ $item->cost }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Adding Meal -->
<div class="modal fade" id="addMealModal" tabindex="-1" aria-labelledby="addMealModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMealModalLabel">Add Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cost.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="user_id" class="form-label">User:</label>
                        <select name="user_id" class="form-select">
                            <option value="" selected disabled>Select a user</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="cost_date" class="form-label">Date:</label>
                        <input type="date" name="cost_date" class="form-control" value="{{ old('cost_date') }}">
                        @error('cost_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter meal" value="{{ old('title') }}">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="cost" class="form-label">Cost Amount:</label>
                        <input type="number" name="cost" class="form-control" placeholder="Enter cost amount" value="{{ old('cost') }}">
                        @error('cost')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection