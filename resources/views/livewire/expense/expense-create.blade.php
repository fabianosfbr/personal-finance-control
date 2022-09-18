<div>

    <x-slot name='header'>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Criar registro
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">      
                <div class="mt-6 text-gray-500">                        
                    <form action=""  wire:submit.prevent='createExpense'>
                        <p>

                            <div>
                                <x-jet-label for="description" value="Descrição do registro" />
                                <x-jet-input wire:model='description' id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus />
                                @error('description')
                                    <h5>{{ $message }}</h5>
                                @enderror
                            
                            </div>
                
                            <div class="mt-4">
                                <x-jet-label for="amount" value="Valor a ser registrado" />
                                <x-jet-input wire:model='amount' id="amount"  class="block mt-1 w-full" type="text" name="amount" required />
                                @error('amount')
                                    <h5>{{ $message }}</h5>
                                @enderror
                            </div>
                            
                        </p>
  
                        <p>
                            <label class="block font-medium text-black">Tipo do registro</label>
                            <select name="type" id="type" wire:model='type'>
                                <option value="">Selecione o tipo do registro</option>
                                <option value="1">Entrada</option>
                                <option value="2">Saída</option>
                            </select>
                            @error('type')
                                <h5>{{ $message }}</h5>
                            @enderror
                        </p>
                        <x-jet-button class="ml-4">
                            Registrar
                        </x-jet-button>
                    </form>
                    </div>
                </div>

            </div>
        </div>
    </div>



    
    
</div>
