<?php

namespace App\Http\Controllers;

use App\Models\BazarCost;
use App\Models\Meal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CostController extends Controller
{

    public function index(Request $request)
    {

        $users = User::all();

        // Set the month and year to filter meals, default to the current month and year
        $month = $request->input('month', now()->format('m'));
        $year = $request->input('year', now()->format('Y'));

        $costs = BazarCost::with('user')
            ->whereYear('cost_date', $year)
            ->whereMonth('cost_date', $month)
            ->get();

        return view('cost.index', compact('users', 'costs', 'month', 'year'));
    }

    // Function to input meals
    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cost_date' => 'required|date',
            'title' => 'required',
            'cost' => 'required|integer',
        ]);

        BazarCost::create([
            'user_id' => $request->user_id,
            'cost_date' => $request->cost_date,
            'title' => $request->title,
            'cost' => $request->cost,

        ]);

        return back()->with('success', 'Cost added successfully.');
    }

    // Display total meals for each user for a month
    public function monthlyTotal(Request $request)
    {
        // Set the month and year to filter meals, default to the current month and year
        $month = $request->input('month', now()->format('m'));
        $year = $request->input('year', now()->format('Y'));

        // Query to get total meals for each user within the given month and year
        $totals = BazarCost::select('user_id', DB::raw('SUM(cost) as total_cost'))
            ->whereYear('cost_date', $year)
            ->whereMonth('cost_date', $month)
            ->groupBy('user_id')
            ->with('user') // Eager load the user relationship
            ->get();
        
        // Calculate the sum of total meals for all users for the month
        $overallTotalMeals = Meal::whereYear('meal_date', $year)
            ->whereMonth('meal_date', $month)
            ->sum('meal_count');

        // Calculate the sum of total meals for all users for the month
        $overallTotalCost = BazarCost::whereYear('cost_date', $year)
            ->whereMonth('cost_date', $month)
            ->sum('cost');

        // Calculate the meal rate (check if overallTotalMeals is not zero to avoid division by zero)
        if ($overallTotalMeals > 0) {
            $mealRate = number_format($overallTotalCost / $overallTotalMeals, 2);
        } else {
            $mealRate = 0; // Set to 0 or handle the case when there are no meals
        }

        return view('cost.monthly_total', compact('totals', 'overallTotalCost', 'overallTotalMeals','mealRate', 'month', 'year'));
    }
}
