<div>

    <x-slot name='header'>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar registro
        </h2>
    </x-slot>
    
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">      
                <div class="mt-6 text-gray-500">                        
                    <form action=""  wire:submit.prevent='updateExpense'>
                        <div class="flex flex-wrap -mx-3 mb-6">

                            <p class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Descrição Registro</label>
                                <input type="text" name="description" wire:model="description"
                                class="block appearance-none w-full bg-gray-200 border @error('description') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                
                            @error('description')
                            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
                            @enderror
                            </p>
                
                            <p class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Valor do Registro</label>
                                <input type="text" name="amount" wire:model="amount"
                                class="block appearance-none w-full bg-gray-200 border @error('amount') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                
                            @error('amount')
                            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
                            @enderror
                
                            </p>

                                            
                            <p class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tipo do Registro</label>
                                <select name="type" id="" wire:model="type" class="block appearance-none w-full bg-gray-200 border @error('type') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="">Selecione o tipo do registro: Entrada ou Saída...</option>
                                    <option value="1">Entrada</option>
                                    <option value="2">Saída</option>
                                </select>
                                @error('type')
                                    <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
                                @enderror
                
                            </p>
              

                            
                        </div>
                        <div class="w-full py-4 px-3 mb-6 md:mb-0">

                            <button type="submit"
                                    class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">Atualizar Registro</button>
                        
                                    <a href="{{ route('dashboard') }}"
                                    class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">Meus Gastos</a>
                        
                        </div>
                    </form>
                    </div>
                </div>

            </div>
        </div>
    </div>



    
</div>
