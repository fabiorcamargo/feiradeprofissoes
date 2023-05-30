<x-app-layout>
    <x-slot name="header">
        
    </x-slot>

    <div class="py-12">
        <h2 class="font-semibold text-center text-xl pb-8 text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nome
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Colégio
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Leads
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Cidade
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Criado
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaders as $leader)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$leader->leader_name}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$leader->school_name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$leader->Leads->count()}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{($leader->City)->name}} - {{($leader->State)->abbr}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$leader->updated_at->format('d-m-Y H:i')}}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        
                                        <a href="{{route('lead.list', ['id' => $leader->id])}}"
                                            class="font-medium text-yellow-400 dark:text-yellow-400 hover:underline">Leads</a>   
                                        <a href="#"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">Excluir</a>
                                            
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
