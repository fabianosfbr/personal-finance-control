<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ExpenseEdit extends Component
{

  
    public $expenseId;
    public $amount;
    public $description;
    public $type;

        // Validation Rules
    protected $rules = [
        'type' => 'required',
        'amount' => 'required',
        'description' => 'required',
    ];

    // Intercept those parameters and store the data as public properties using the mount() method/lifecycle hook.
    public function mount(Expense $expense)
    {       
        $this->expenseId = $expense->id;
        $this->type = $expense->type;
        $this->description = $expense->description;
        $this->amount = $expense->amount;

    }

    public function render()
    {
        return view('livewire.expense.expense-edit');
    }

    public function updateExpense()
    {
        $this->validate();

        try{

            Auth::user()->expenses()->find($this->expenseId)->fill([
                'type' => $this->type,
                'amount' => $this->amount,
                'description' => $this->description,
            ])->save();

            // Set Flash Message
           $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'position'=>'top-end',
                'message'=>"Register updated successfully"
            ]);


        }catch(Exception $e){
            // Set Flash Message
           $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'position'=>'top-end',
                'message'=>"Sorry, try again"
            ]);
        }
    }
}