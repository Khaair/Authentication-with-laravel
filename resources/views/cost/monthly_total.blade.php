@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header  pt-5 pb-5">
            <h3>Total Bazar Cost for {{ $month }}/{{ $year }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('cost.monthly-total') }}" method="GET" class="mb-4 row">
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
                        <th>Total Bazar Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($totals as $total)
                        <tr>
                            <td>{{ $total->user->name }}</td>
                            <td>{{ $total->total_cost }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
            <div>Total Bazar Cost: {{$overallTotalCost}}</div> 
            <div>Total Meals: {{$overallTotalMeals}}</div>
            <div>Meal Rate: {{$mealRate}}</div>
        </div>
    </div>
</div>
@endsection
