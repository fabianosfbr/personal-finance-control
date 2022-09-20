<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseCreate extends Component
{
    use WithFileUploads;
    public $amount;
    public $description;
    public $type;
    public $photo;
    public $expenseDate;

    // Validation Rules
    protected $rules = [
        'type' => 'required',
        'amount' => 'required',
        'description' => 'required',
        'photo' => 'image|max:5000',
        
    ];
    
    public function render()
    {
        return view('livewire.expense.expense-create');
    }

    public function createExpense()
    {
        $this->validate();

        if(!is_null($this->photo))
        {
            /**
            if(Storage::disk('public')->exists($this->expense->photo)){
                Storage::disk('public')->delete($this->expense->photo);
            }
             */
            
            $this->photo = $this->photo->store('expenses-photos', 'public');
        }
        
        try{
            $expense = Auth::user()->expenses()->create([
                'type' => $this->type,
                'amount' => $this->amount,
                'description' => $this->description,
                'user_id' => Auth::user()->id,
                'photo' =>  $this->photo ?? null,
                'expense_data' => $this->expenseDate,
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
        $this->photo = null;
        $this->expenseDate = null;
    }
}