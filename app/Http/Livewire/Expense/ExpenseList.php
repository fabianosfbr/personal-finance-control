<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseList extends Component
{
    use WithPagination;

    public $showModal = false;
    public $expenseIdBeingDeleted;

    public function render()
    {
        $expenses = Auth::user()->expenses()->orderBy('created_at', 'DESC')->paginate(5);
        
        return view('livewire.expense.expense-list', compact('expenses'));
    }

    public function deleteExpense()
    {
        $expense = Auth::user()->expenses()->find($this->expenseIdBeingDeleted);
        $expense->delete();
        $this->showModal = false;

        $this->dispatchBrowserEvent('alert',[
            'type'=>'sucess',
            'position'=>'top-end',
            'message'=>"Removed successfully"
        ]);
    }

    public function confirmExpenseDeletion($id)
    {
        $this->showModal = true;
        $this->expenseIdBeingDeleted = $id;
    }
}