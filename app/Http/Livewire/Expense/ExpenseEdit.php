<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseEdit extends Component
{

    use WithFileUploads;
    
    public $expenseId;
    public $amount;
    public $description;
    public $type;
    public $photo;
    public $expense;

        // Validation Rules
    protected $rules = [
        'type' => 'required',
        'amount' => 'required',
        'description' => 'required',
        'photo' => 'sometimes|max:5000',
    ];

    // Intercept those parameters and store the data as public properties using the mount() method/lifecycle hook.
    public function mount(Expense $expense)
    {      
        $this->expense = $expense; 
        $this->expenseId = $expense->id;
        $this->type = $expense->type;
        $this->description = $expense->description;
        $this->amount = $expense->amount;
        $this->photo = $expense->photo;
       // dd($expense);

    }

    public function render()
    {
        return view('livewire.expense.expense-edit');
    }

    public function updateExpense()
    {
        $this->validate();

  

        if(!is_null($this->photo))
        {
            if(Storage::disk('public')->exists($this->expense->photo)){
                Storage::disk('public')->delete($this->expense->photo);
            }
            
            $this->photo = $this->photo->store('expenses-photos', 'public');
           
        }

        try{

            Auth::user()->expenses()->find($this->expenseId)->fill([
                'type' => $this->type,
                'amount' => $this->amount,
                'description' => $this->description,
                'photo' => $this->photo ?? $this->expense->photo,
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