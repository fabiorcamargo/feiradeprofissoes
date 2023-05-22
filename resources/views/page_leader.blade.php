<x-app-layout>
    <x-slot name="header">
        {{--<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>--}}
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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



    <div class="bg-gray-200 dark:bg-zinc-950 pb-20">

        <div class="mx-auto max-w-7xl py-6 sm:px-6 sm:py-10 lg:px-8">
            <div
                class="relative isolate overflow-hidden shadow-sky-500/40 dark:shadow-sky-500/40 bg-sky-950 px-6 pt-16 shadow-xl rounded-lg sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
                <svg viewBox="0 0 1024 1024"
                    class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-y-1/2 [mask-image:radial-gradient(closest-side,white,transparent)] sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0"
                    aria-hidden="true">
                    <circle cx="512" cy="512" r="512" fill="url(#759c1415-0410-454c-8f7c-9a820de03641)"
                        fill-opacity="0.7" />
                    <defs>
                        <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641">
                            <stop stop-color="#7775D6" />
                            <stop offset="1" stop-color="#7775D6" />
                        </radialGradient>
                    </defs>
                </svg>
                <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Portal do Representante de
                        Turma
                    </h2>
                    <p class="mt-6 text-lg leading-8 text-gray-300">Parabéns se você chegou até aqui é porque você foi
                        escolhido como representante de sala, continue sendo esforçado e responsável que você terá uma
                        brilhante carreira.</p>
                    <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start">
                        <a href="#cadastro"
                            class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Cadastre-se</a>
                        <a href="#" class="text-sm font-semibold leading-6 text-white">Saiba mais <span
                                aria-hidden="true">→</span></a>
                    </div>
                </div>
                <div class="relative mt-16 h-80 lg:mt-8">
                    <img class="absolute left-0 top-0 w-[40rem] max-w-none rounded-md bg-white/5 ring-1 ring-white/10"
                        src="{{asset('storage/img/leader.jpg')}}" alt="App screenshot" width="500" height="500">
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-7xl py-6 sm:px-6 sm:py-10 lg:px-8">
            <section
                class="relative isolate overflow-hidden bg-white dark:bg-gray-800 px-6 py-16 shadow-xl rounded-lg sm:px-16 sm:py-16 md:py-5 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
                <div class="mx-auto max-w-full text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Indicações da
                        turma:</h5>
                    <p class="mt-6 text-lg leading-8 text-gray-900 dark:text-white">Insira seus dados abaixo para
                        iniciar as
                        indicações:</p>
                    <div class="grid gap-2 md:grid-cols-2">
                        <div class="row">
                            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')"
                                placeholder="Nome Líder de Turma" required autocomplete="given-name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="row">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-300 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600">
                                    <img src="{{asset('/storage/img/flag-brazil.svg')}}" width="40px" alt="Brasil">
                                    <h4 class="mr-8 ml-2">+55 </h4>
                                </span>
                                <input type="tel" id="tel" name="tel" minlength="14" maxlength="15"
                                    placeholder="(99) 9 9999-9999"
                                    pattern="(\([0-9]{2}\))\s([9]{1})?([0-9]{4})-([0-9]{4})"
                                    title="(99) 9 9999-9999 (Coloque seu telefone nesse formato)" required="required"
                                    onkeyup="handlePhone(event)"
                                    class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-r-lg shadow-sm"
                                    required autocomplete="tel">
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">

                        <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')"
                            placeholder="Nome da Escola" required autocomplete="given-name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="grid gap-2 mt-2 md:grid-cols-2">
                        <div class="">
                            <select id="state" name="state"
                                class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-r-lg shadow-sm"
                                required autocomplete="state">
                                <option value="">Selecione seu Estado</option>
                                @foreach ($states as $key => $value)
                                <option value="{{ $value['id'] }}" {{ old('state')==$value['id'] ? 'selected' : '' }}>{{
                                    $value['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="">
                            <select id="city" name="city"
                                class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-r-lg shadow-sm"
                                required autocomplete="city">
                                @if(old('city') != null)
                                <option value="{{old('city')}} 'selected'">
                                    {{App\Models\City::find(old('city'))->name}}</option>
                                @else
                                <option>Selecione sua Cidade</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-center gap-x-6 mt-6 lg:justify-start">
                        <a href="#cadastro"
                            class="add_form_field flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Prosseguir...</a>
                        {{--<a href="#" class="text-sm font-semibold leading-6 text-white">Saiba mais
                            <span aria-hidden="true">→</span></a>--}}
                    </div>

                </div>
            </section>
        </div>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 sm:py-10 lg:px-8">
            <section
                class="relative isolate overflow-hidden bg-white dark:bg-gray-800 px-6 py-16 shadow rounded-lg sm:px-16 sm:py-16 md:py-5 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
                <div class="mx-auto max-w-full text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">1ª Indicação
                    </h5>
                    <div class="grid gap-2 md:grid-cols-2">
                        <div class="row">
                            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')"
                                placeholder="Nome do Aluno" required autocomplete="given-name" />
                            <x-input-error :messages="$errors->get(" name")" class="mt-2" />
                        </div>
                        <div class="row">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-300 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600">
                                    <img src="{{asset("/storage/img/flag-brazil.svg")}}" width="40px" alt="Brasil">
                                    <h4 class="mr-8 ml-2">+55 </h4>
                                </span>
                                <input type="tel" id="tel" name="tel" minlength="14" maxlength="15"
                                    placeholder="(99) 9 9999-9999"
                                    pattern="(\([0-9]{2}\))\s([9]{1})?([0-9]{4})-([0-9]{4})"
                                    title="(99) 9 9999-9999 (Coloque o telefone nesse formato)" required="required"
                                    onkeyup="handlePhone(event)"
                                    class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-r-lg shadow-sm"
                                    required autocomplete="tel">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="container1">
        </div>
        <div class="text-center">
            <a href="javascript:void(0);" type="button"
                class="animate-bounce add_form_field text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <x-heroicon-m-user-plus class="w-6 h-6" fill="currentColor" />
                <p> Adicionar</p>

                <span class="sr-only">Icon description</span>
            </a>
            <a href="javascript:void(0);" type="button"
                class="add_form_field text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-green-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <x-carbon-send class="w-6 h-6" fill="currentColor" />
                <p> Enviar</p>

                <span class="sr-only">Icon description</span>
            </a>
        </div>

    </div>

    <footer class="">
        <div class="pt-4 pb-1 bg-white dark:bg-gray-800">
            <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
                <div class="md:flex md:justify-between">
                    <div class="mb-6 md:mb-0">
                        <a href="#cadastro" class="flex items-center">
                            <img src="{{asset('storage/img/logo.svg')}}" class="h-8 mr-3" alt="" />
                            <span
                                class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Pré-Militar</span>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-2">
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Sobre
                            </h2>
                            <ul class="text-gray-600 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <a href="https://flowbite.com/" class="hover:underline">Quem Somos</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal
                            </h2>
                            <ul class="text-gray-600 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <a href="#" class="hover:underline">Política de Privacidade</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 Pré-Militar™
                        Todos
                        os
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
    <script type="text/javascript">
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
    </script>

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
        $(document).ready(function() {
        var max_fields = 10;
        var wrapper = $(".container1");
        var add_button = $(".add_form_field");

        var x = 1;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<div class="mx-auto max-w-7xl py-6 sm:px-6 sm:py-10 lg:px-8"><section    id="sec'+x+'"            class="relative isolate overflow-hidden bg-white dark:bg-gray-800 px-6 py-16 shadow-2xl rounded-lg sm:px-16 sm:py-16 md:py-5 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">                <div class="mx-auto max-w-full text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">'+x+'ª Indicação                    </h5>                    <div class="grid gap-2 md:grid-cols-2">                        <div class="row">                            <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block w-full" id="name" type="text" name="name" placeholder="Nome do Aluno" required="required" autocomplete="given-name">                                                    </div>                        <div class="row">                            <div class="flex">                                <span                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-white border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600">                                    <img src="{{asset("/storage/img/flag-brazil.svg")}}" width="40px" alt="Brasil">                                    <h4 class="mr-8 ml-2">+55 </h4>                                </span>                                <input type="tel" id="tel" name="tel" minlength="14" maxlength="15"                                    placeholder="(99) 9 9999-9999"                                    pattern="(\([0-9]{2}\))\s([9]{1})?([0-9]{4})-([0-9]{4})"                                    title="(99) 9 9999-9999 (Coloque o telefone nesse formato)" required="required"                                    onkeyup="handlePhone(event)"                                    class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-r-lg shadow-sm"                                    required autocomplete="tel">                            </div>                        </div>                    </div>                    <div class="flex items-center justify-center gap-x-6 mt-6 lg:justify-start">                        <a href="javascript:void(0);"                            class="add_form_field flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Link</a>                        {{--<a href="#" class="text-sm font-semibold leading-6 text-white">Saiba mais                            <span aria-hidden="true"></span></a>--}}                    </div>                </div>            </section></div>'); //add input box

                window.location.href='#sec'+x;

            } else {
                alert('O Limite de indicações são 10.')
            }
        });

        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
    </script>

    @if(env('APP_DEBUG') == false)

    @endif



</x-app-layout>