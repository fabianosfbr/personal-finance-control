<div class="max-w-7xl mx-auto p-12 px-4">

    <div class="w-full mx-auto text-right mb-6">
        <a href="{{route('expenses.create')}}" class="flex-shrink-0 bg-indigo-500 hover:bg-indigo-700 border-indigo-500 hover:border-indigo-700 text-sm border-4 text-white py-1 px-2 rounded">Criar Registro</a>
    </div>


    @if(!empty($expenses) and !$expenses->isEmpty())
        <table class="table-auto w-full mx-auto">
            <thead>
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2 text-left">Descrição</th>
                <th class="px-4 py-2 text-left">Valor</th>
                <th class="px-4 py-2 text-left">Tipo</th>
                <th class="px-4 py-2 text-left">Data registro</th>
                <th class="px-4 py-2 text-center">Ações</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($expenses as $expense)
                    <tr>
                        <td class="px-4 py-2 border">{{ $expense->id }}</td>
                        <td class="px-4 py-2 border">{{ $expense->description }}</td>
                        <td class="px-4 py-2 border">R$ {{ number_format($expense->amount, 2 ,',', '.')}}</td>
                        <td class="px-4 py-2 border text-center">
                            @if ($expense->type == 1)
                            <div class="inline-block leading-tight text-center font-semibold py-1 px-3 bg-green-100 text-green-700 dark:bg-opacity-80 rounded-full">Entrada</div>
                            @else
                            <div class="inline-block leading-tight text-center font-semibold py-1 px-3 bg-pink-100 text-pink-700 dark:bg-opacity-80 rounded-full">Saída</div>
                  
                            @endif
                            
                        </td>
                        <td class="px-4 py-2 border">{{ $expense->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 border text-center">
                            
                            <a href="#" wire:click="confirmExpenseDeletion({{ $expense->id }})" class="inline-block ltr:mr-2 rtl:ml-2 hover:text-red-500" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                </svg>
                              </a>
                              <a href="{{ route('expenses.edit', $expense->id) }}" class="inline-block ltr:mr-2 rtl:ml-2 hover:text-green-500" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                                </svg>
                              </a>              
                        </td>
                    </tr>
                    
                @endforeach
            

            </tbody>
        </table>

        <div class="w-full mx-auto mt-10">
            {{$expenses->links()}}
        </div> 
    @else
        <div class="flex">
            <div>Não há nehum lançamento. </div>
            <a href="{{ route('expenses.create') }}">Clique aqui para cadastrar</a>
        </div>
        
    @endif


   
          
    <x-jet-confirmation-modal wire:model="showModal">
        <x-slot name="title">
            Confirmar remoção
        </x-slot>

        <x-slot name="content">
            Tem certeza que deseja remover
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="deleteExpense" wire:loading.attr="disabled">
                Remover
            </x-jet-danger-button>

            <x-jet-secondary-button class="ml-3" wire:click="$toggle('showModal')" wire:loading.attr="disabled" >
                Cancelar
            </x-jet-secondary-button >


        </x-slot>
    </x-jet-confirmation-modal>

</div>
