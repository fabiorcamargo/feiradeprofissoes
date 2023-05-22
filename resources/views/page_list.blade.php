<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
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
                                        Slug
                                    </th>
                                    
                                    <th scope="col" class="px-6 py-3">
                                        Leads
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Criado
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Atualizado
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pages as $page)
                                    
                               
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$page->name}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$page->slug}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$page->Leads->count()}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$page->created_at->format('d-m-Y H:i')}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$page->updated_at->format('d-m-Y H:i')}}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{route('page.show', ['slug' => $page->slug])}}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Página</a>
                                        <a href="{{route('lead.list', ['id' => $page->id])}}"
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