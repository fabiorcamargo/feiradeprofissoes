<x-app-layout>
    <x-slot name="">
        {{--<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>--}}
    
       
    </x-slot>

    <!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->


    <div class="w-full bg-cover bg-center" style="height:32rem; background-image: url({{asset('storage/img/feira.jpg')}});">
        <div class="flex items-center justify-center h-full w-full bg-gray-900 bg-opacity-50">
            <div class="text-center">
                <div class="flex items-center justify-center lg:justify-start">
                    <img src="{{asset('storage/img/logo.svg')}}" class="h-8 mr-3" alt="{{env('APP_NAME')}}" />
                    <h2
                        class="text-2xl font-bold tracking-tight sm:text-4xl block bg-gradient-to-r from-sky-500 via-blue-300 to-blue-200 bg-clip-text text-transparent">
                        {{env('APP_NAME')}}</h2>
                </div>
                
                <p class="mt-6 text-xl leading-8 text-gray-200 dark:text-white">Programa Nacional de tendência de mercado para Jovens e Adolescentes.</p>
                <button   class="mt-4 px-4 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">Saiba Mais</button>
            </div>
        </div>
    </div>



    <div class="max-w-7xl mx-auto p-6 lg:p-8">

        <section id="info" class="">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">

                @foreach ($posts as $post)
                
                 <x-modal.video id="{{$post->id}}" url="{{$post->url}}"  />
                <div
                class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-gray-500">
                <div class="grid grid-rows-1">
                    <div href="#cadastro" class="row">
                        <button onclick="Livewire.emit('openModal', 'edit-user', {{ json_encode(['post' => $post->id]) }})"><img class="rounded-md bg-white/5 ring-1 ring-white/10"
                            src="{{asset("$post->img")}}" alt="App screenshot" 
                            height="500"></button>
                        
                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{$post->title}}</h2>

                        <p class="mt-2 text-justify text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            {!!$post->body!!}
                        </p>
                    </div>
                    
                    <div class="row-end-4">
                        <x-card.like-footer q="{{$post->like}}" l='{{$post->id}}' />
                        </div>
                </div>
                
                
            </div>
                @endforeach

        </section>

    </div>

    {{--}}
    <section class="">
        <div class="isolate bg-white dark:bg-gray-900 px-6 py-10 sm:py-12 lg:px-8">
            <div class="relative isolate px-6 pt-14 lg:px-8">

                <div class="mx-auto max-w-2xl py-10 sm:py-12 lg:py-15">
                    <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                        <div
                            class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 dark:text-gray-200 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                            Announcing our next round of funding. <a href="#"
                                class="font-semibold text-indigo-600 dark:text-indigo-400"><span
                                    class="absolute inset-0" aria-hidden="true"></span>Read more <span
                                    aria-hidden="true">&rarr;</span></a>
                        </div>
                    </div>
                    <div class="text-center">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-gray-100 sm:text-6xl">Data
                            to
                            enrich your online business</h1>
                        <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-200">Anim aute id magna aliqua ad
                            ad
                            non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam
                            occaecat
                            fugiat aliqua.</p>
                        <div class="mt-10 flex items-center justify-center gap-x-6">
                            <a href="#"
                                class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get
                                started</a>
                            <a href="#" class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-300">Learn
                                more
                                <span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>--}}
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        
    </div>


    @livewire('livewire-ui-modal')
    @livewireScripts
    <footer class="pt-20">
        <div class="pt-4 pb-1">
            <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8 shadow">
                <div class="md:flex md:justify-between">
                    <div class="mb-6 md:mb-0">
                        <a href="#cadastro" class="flex items-center">
                            <img src="{{asset('storage/img/logo.svg')}}" class="h-8 mr-3" alt="{{env('APP_NAME')}}" />
                            <h4
                        class="text-md font-bold tracking-tight sm:text-2xl block bg-gradient-to-r from-sky-500 via-blue-300 to-blue-200 bg-clip-text text-transparent">
                        {{env('APP_NAME')}}</h4>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-2">
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Sobre</h2>
                            <ul class="text-gray-600 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <a href="#cadastro" class="hover:underline">Quem Somos</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                            <ul class="text-gray-600 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <a href="#cadastro" class="hover:underline">Política de Privacidade</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 {{env('APP_NAME')}}™ Todos os
                        direitos resevados.
                    </span>
                    <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Facebook page</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Instagram page</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                            <x-ri-youtube-line class="w-5 h-5" />
                            <span class="sr-only">Instagram page</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
   {{--}} <script type="text/javascript">
        $(document).ready(function() {
            
            $('select[name="state"]').on('change', function() {
                var stateID = $(this).val();
                if(stateID) {
                    $.ajax({
                        url: '/city/'+stateID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {   
                            console.log("teste");   
                            var city = "1";                
                            $('select[name="city"]').empty();
                            $.each(data, function(key, value) {
                            $('select[name="city"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="city"]').empty();
                }
            });
        });
    </script> --}}

    <script>
        const handlePhone = (event) => {
        let input = event.target
        input.value = phoneMask(input.value)
        }

        const phoneMask = (value) => {
        if (!value) return ""
        value = value.replace(/\D/g,'')
        value = value.replace(/(\d{2})(\d)/,"($1) $2")
        value = value.replace(/(\d)(\d{4})$/,"$1-$2")
        return value
        }
    </script>

    
    <script>
        function like_up(id){
            console.log(id);
            httpGet('like/up/'+id);
        }
        function httpGet(theUrl)
        {
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
            xmlHttp.send( null );
            return xmlHttp.responseText;
        }
    </script>
    


</x-app-layout>