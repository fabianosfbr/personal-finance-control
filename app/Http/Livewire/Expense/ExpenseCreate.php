<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ExpenseCreate extends Component
{
    public $amount;
    public $description;
    public $type;

    // Validation Rules
    protected $rules = [
        'type' => 'required',
        'amount' => 'required',
        'description' => 'required',
    ];
    
    public function render()
    {
        return view('livewire.expense.expense-create');
    }

    public function createExpense()
    {
        $this->validate();
        
        try{
            $expense = Expense::create([
                'type' => $this->type,
                'amount' => $this->amount,
                'description' => $this->description,
                'user_id' => Auth::user()->id,
            ]);
    
    
           // Set Flash Message
           $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'position'=>'top-end',
                'message'=>"Register successfully"
            ]);
    
            // zera inputs fields
            $this->resetFields();

        }catch(Exception $e){
            // Set Flash Message
           $this->dispatchBrowserEvent('alert',[
            'type'=>'error',
            'position'=>'top-end',
            'message'=>"Sorry, try again"
        ]);
        }
    }

    public function resetFields(){
        $this->type = null;
        $this->description = null;
        $this->amount = null;
    }
}