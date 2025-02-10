<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MealController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        return view('meals.index', compact('users'));
    }
    // Function to input meals
    public function store(Request $request)
    {
       
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'meal_count' => 'required|integer',
            'meal_date' => 'required|date',
        ]);

        Meal::create([
            'user_id' => $request->user_id,
            'meal_count' => $request->meal_count,
            'meal_date' => $request->meal_date,
        ]);

        return back()->with('success', 'Meal added successfully.');
    }

    // Display total meals for each user for a month
    public function monthlyTotal(Request $request)
    {
        // Set the month and year to filter meals, default to the current month and year
        $month = $request->input('month', now()->format('m'));
        $year = $request->input('year', now()->format('Y'));

        // Query to get total meals for each user within the given month and year
        $totals = Meal::select('user_id', DB::raw('SUM(meal_count) as total_meals'))
            ->whereYear('meal_date', $year)
            ->whereMonth('meal_date', $month)
            ->groupBy('user_id')
            ->with('user') // Eager load the user relationship
            ->get();

        // Calculate the sum of total meals for all users for the month
        $overallTotalMeals = Meal::whereYear('meal_date', $year)
            ->whereMonth('meal_date', $month)
            ->sum('meal_count');

         

        return view('meals.monthly_total', compact('totals', 'overallTotalMeals', 'month', 'year'));
    }
}
