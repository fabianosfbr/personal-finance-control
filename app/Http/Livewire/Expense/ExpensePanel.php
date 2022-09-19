<?php

namespace App\Http\Livewire\Expense;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ExpensePanel extends Component
{

    
    public function render()
    {
        $totalExpense = Auth::user()->expenses()->count();
        $totalCredits = Auth::user()->expenses()->where('type', 1)->sum('amount')/100;
        $totalDebits = Auth::user()->expenses()->where('type', 2)->sum('amount')/100;
        $result = $totalCredits - $totalDebits;


        
        return view('livewire.expense.expense-panel', [
                                        'totalExpense' => $totalExpense, 
                                        'totalCredits'=> $totalCredits, 
                                        'totalDebits'=> $totalDebits,
                                        'result' => $result
                                    ]);
    }
}