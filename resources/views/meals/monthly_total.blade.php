@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header pt-5 pb-5">
            <h3>Total Meals for {{ $month }}/{{ $year }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('meals.monthly-total') }}" method="GET" class="mb-4 row">
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

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>User</th>
                        <th>Total Meals</th>
                        <th>Meal Rate</th>
                        <th>Total cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userWiseTotalMeals as $item)
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->total_meals }}</td>
                        <td>{{ $mealRate }}</td>
                        <td>{{ $item->total_meals * $mealRate }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>Total: {{$overallTotalMeals}} </div>
        </div>
    </div>
</div>
@endsection