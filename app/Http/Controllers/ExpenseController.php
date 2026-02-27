<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            "category" => "string|required",
            "amount" => "required",
            "description" => "string|required",
            "date" => "required|date"
        ]);

        try {

            $expense = Auth::user()->expenses()->create([
                ...$validated
            ]);
            
            return response()->json([
                "message" => "Expense created successfully!",
                "date" => $expense
            ]);

        } catch(\Exception $e) {
            return response()->json([
                "message" => "Error to create an expense",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Expense $id)
    {
        
    }

    public function destroy($id)
    {
        $expense = Expense::where("user_id", Auth::id())->findOrFail($id);
        $expense->delete();
        return response()->json(["message" => "Expense deleted successfully!."]);
    }
}