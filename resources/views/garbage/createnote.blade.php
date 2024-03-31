<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Trixx -->
    {{-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css"> --}}
    {{-- <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script> --}}

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- contoh alpinejs --}}

<body class="font-sans antialiased">
    {{-- <div class="flex justify-center">
        <div x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }
        
                this.$refs.button.focus()
        
                this.open = true
            },
            close(focusAfter) {
                if (!this.open) return
        
                this.open = false
        
                focusAfter && focusAfter.focus()
            }
        }" x-on:keydown.escape.prevent.stop="close($refs.button)"
            x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']"
            class="relative">
            <!-- Button -->
            <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
                type="button" class="flex items-center gap-2 bg-white px-5 py-2.5 rounded-md shadow">
                Options

                <!-- Heroicon: chevron-down -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Panel -->
            <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
                :id="$id('dropdown-button')" style="display: none;"
                class="absolute left-0 mt-2 w-40 rounded-md bg-white shadow-md">
                <a href="#"
                    class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                    New Task
                </a>

                <a href="#"
                    class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                    Edit Task
                </a>

                <a href="#"
                    class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                    <span class="text-red-600">Delete Task</span>
                </a>
            </div>
        </div>
    </div> --}}
    <section class="flex justify-center mt-24 mx-6 md:mx-6 sm:mx-6 lg:mx-12">
        <div
            class="bg-white border border-slate-500 rounded shadow-md overflow-hidden md:flex md:flex-col lg:flex lg:flex-col">
            <div class="px-6 py-4 bg-gray-200 rounded-t-md border-b border-slate-950">
                <div class="font-bold text-xl">Add Note</div>
            </div>
            <div class="mx-auto px-6 py-4 md:w-5/6 lg:w-full">
                {{-- <p class="text-gray-700 text-base">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna risus, pulvinar sed magna
                    eget, ullamcorper hendrerit libero.
                </p> --}}
                <form x-data="{ notes: '' }" x-on:submit.prevent="addData" action="{{ route('add-note') }}"
                    method="POST">
                    @csrf
                    <div class="w-full">
                        {{-- <input id="notes" type="text" name="notes" x-model="notes"> --}}

                        <input id="notes" type="hidden" name="notes" x-model="notes">
                        <trix-editor input="notes" class="w-full h-64 lg:full md:h-auto overflow-y-auto"></trix-editor>
                    </div>

                    <div class="flex justify-end mt-5 gap-2">
                        {{-- <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add</button>
                        <button type="button"
                            class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded ml-2">Cancel</button> --}}
                        <button
                            class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                            type="button">
                            Add
                        </button>
                        <button
                            class="select-none rounded-lg border border-gray-900 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            Cancel
                        </button>
                    </div>
                </form>

                <script>
                    function addData() {
                        const notes = document.getElementById('notes').value;
                        console.log(notes)
                        // axios.post('{{ route('add-note') }}', {
                        //         notes: notes
                        //     })
                        //     .then(response => {
                        //         if (response.data.success) {
                        //             // Tampilkan pesan sukses atau lakukan hal lain yang diinginkan
                        //             alert('Data berhasil ditambahkan');
                        //         } else {
                        //             // Tampilkan pesan error atau lakukan hal lain yang diinginkan
                        //             alert('Terjadi kesalahan: ' + response.data.message);
                        //         }
                        //     })
                        //     .catch(error => {
                        //         // Tampilkan pesan error atau lakukan hal lain yang diinginkan
                        //         alert('Terjadi kesalahan: ' + error);
                        //     });
                    }
                </script>

            </div>
            <div class="px-6 pt-4 pb-2 flex flex-wrap justify-start">

            </div>
        </div>

    </section>


    <button x-data="{ showContent: false }" @click="showContent = true">Trigger</button>
    <div id="content" x-data="{ showContent: false }" x-show="showContent">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
    </div>


    <div id="parent" x-data="{ open: false }" class="bg-blue-gray-700 p-12">
        <div id="child">
            <button @click="open = true">Expands</button>

            <div x-show="open">
                Content...
            </div>
        </div>
    </div>
    <div x-data="{ open: false }">
        <button @click="open = true">Expand</button>

        <div x-show="open" @click.away="open = false">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        </div>
    </div>

    <div id="parent" x-data="{ open: false }" class="bg-blue-gray-700 p-12">
        <div id="child">
            <button @click="open = !open">Toggless</button>

            <div x-cloak x-show="open">
                Content...
            </div>
        </div>
    </div>




    <div x-data="{ show: false }">
        <button @click="show = !show">Toggle</button>

        <div :class="{ 'opacity-0': !show, 'opacity-100': show }" class="transition duration-300 ease-in-out">
            <p>Content...</p>
        </div>
    </div>

    <div x-data="{ show: false }">
        <button data-ripple-light="true" data-dialog-target="dialog-xl" @click="show = !show"
            class="select-none rounded-lg bg-gradient-to-tr from-gray-900 to-gray-800 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
            Open Dialog XL
        </button>
        <div data-dialog-backdrop="dialog-xl" :class="{ 'opacity-0 pointer-events-none': !show, 'opacity-100': show }"
            data-dialog-backdrop-close="true"
            class="fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
            <form action="" method="POST">
                @csrf
                <div data-dialog="dialog-xl"
                    class="relative m-4 w-full min-w-[15%] max-w-[75%] rounded-lg bg-white font-sans text-base font-light leading-relaxed text-blue-gray-500 antialiased shadow-2xl">
                    <div
                        class="flex flex-row justify-between items-center p-4 font-sans text-2xl antialiased font-semibold leading-snug shrink-0 text-blue-gray-900">
                        <div>
                            <p>Add Notes</p>
                        </div>
                        <div class="pe-2" @click="show =!show">
                            <button type="button" class="w-[16px] h-[16px]">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div
                        class="relative p-4 font-sans text-base antialiased font-light leading-relaxed border-t border-b border-t-blue-gray-100 border-b-blue-gray-100 text-blue-gray-500">
                        <div>
                            <section class="flex justify-center mt-24 mx-6 md:mx-6 sm:mx-6 lg:mx-12">
                                <div
                                    class="bg-white border border-slate-500 rounded shadow-md overflow-hidden md:flex md:flex-col lg:flex lg:flex-col">
                                    <div class="px-6 py-4 bg-gray-200 rounded-t-md border-b border-slate-950">
                                        <div class="font-bold text-xl">Add Note</div>
                                    </div>
                                    <div class="mx-auto px-6 py-4 md:w-5/6 lg:w-full">
                                        <div class="w-full">
                                            <input id="notes" type="hidden" name="notes" x-model="notes">
                                            <trix-editor input="notes"
                                                class="w-full h-64 lg:full md:h-auto overflow-y-auto"></trix-editor>
                                        </div>

                                        <div class="flex justify-end mt-5 gap-2">
                                            <button
                                                class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                                                type="button">
                                                Add
                                            </button>
                                            <button
                                                class="select-none rounded-lg border border-gray-900 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                type="button">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                    <div class="px-6 pt-4 pb-2 flex flex-wrap justify-start">

                                    </div>
                                </div>

                            </section>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center justify-end p-4 shrink-0 text-blue-gray-500">
                        <button data-ripple-dark="true" type="button" data-dialog-close="true" @click="show = !show"
                            class="px-6 py-3 mr-1 font-sans text-xs font-bold text-red-500 uppercase transition-all rounded-lg middle none center hover:bg-red-500/10 active:bg-red-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            Cancel
                        </button>
                        <button data-ripple-light="true" data-dialog-close="true" type="submit"
                            class="middle none center rounded-lg bg-gradient-to-tr from-green-600 to-green-400 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div x-data="{ open: false }">
        <button @click="open = true">Open Modal</button>

        <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto">
            <div
                class="flex items-center justify-center min-height-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span
                    class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m-2-2l-2 2" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Modal title
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam lectus,
                                        hendrerit id orci eget, tincidunt ultricies eros. Cras vehicula tincidunt lacus,
                                        a ultricies neque ultricies eget. Sed eu orci eu massa ultricies posuere. Donec
                                        id elit non mi porta gravida at eget metus.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6">
                            <button @click="open = false"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto sm:text-sm">
                                Close
                            </button>
                        </div>
                    </div>
                </span>
            </div>
        </div>
    </div>

    <div x-data="{ open: false }">
        <button @click="open = true">Open Modal</button>

        <div x-show="open" :class="{ 'none': !open, 'fixed z-10 inset-0 overflow-y-auto': open }"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
            <div
                class="flex flex-col justify-center items-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75">

                    </div>
                </div>

                <span
                    class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m-2-2l-2-2" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Modal title
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam lectus,
                                        hendrerit id orci eget, tincidunt ultricies eros. Cras vehicula tincidunt lacus,
                                        a ultricies neque ultricies eget. Sed eu orci eu massa ultricies posuere. Donec
                                        id elit non mi porta gravida at eget metus.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6">
                            <button @click="open = false"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto sm:text-sm">
                                Close
                            </button>
                        </div>
                    </div>
                </span>
            </div>
        </div>
    </div>




    <div x-data="{ modelOpen: false }">
        <button @click="modelOpen =!modelOpen"
            class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                    clip-rule="evenodd" />
            </svg>

            <span>Invite Member</span>
        </button>

        <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 ">Invite team memebr</h1>

                        <button @click="modelOpen = false"
                            class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>

                    <p class="mt-2 text-sm text-gray-500 ">
                        Add your teammate to your team and start work to get things done
                    </p>

                    <form class="mt-5">
                        <div>
                            <label for="user name"
                                class="block text-sm text-gray-700 capitalize dark:text-gray-200">Teammate name</label>
                            <input placeholder="Arthur Melo" type="text"
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>

                        <div class="mt-4">
                            <label for="email"
                                class="block text-sm text-gray-700 capitalize dark:text-gray-200">Teammate
                                email</label>
                            <input placeholder="arthurmelo@example.app" type="email"
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>

                        <div class="mt-4">
                            <h1 class="text-xs font-medium text-gray-400 uppercase">Permissions</h1>

                            <div class="mt-4 space-y-5">
                                <div class="flex items-center space-x-3 cursor-pointer" x-data="{ show: true }"
                                    @click="show =!show">
                                    <div class="relative w-10 h-5 transition duration-200 ease-linear rounded-full"
                                        :class="[show ? 'bg-indigo-500' : 'bg-gray-300']">
                                        <label for="show" @click="show =!show"
                                            class="absolute left-0 w-5 h-5 mb-2 transition duration-100 ease-linear transform bg-white border-2 rounded-full cursor-pointer"
                                            :class="[show ? 'translate-x-full border-indigo-500' :
                                                'translate-x-0 border-gray-300'
                                            ]"></label>
                                        <input type="checkbox" name="show"
                                            class="hidden w-full h-full rounded-full appearance-none active:outline-none focus:outline-none" />
                                    </div>

                                    <p class="text-gray-500">Can make task</p>
                                </div>

                                <div class="flex items-center space-x-3 cursor-pointer" x-data="{ show: false }"
                                    @click="show =!show">
                                    <div class="relative w-10 h-5 transition duration-200 ease-linear rounded-full"
                                        :class="[show ? 'bg-indigo-500' : 'bg-gray-300']">
                                        <label for="show" @click="show =!show"
                                            class="absolute left-0 w-5 h-5 mb-2 transition duration-100 ease-linear transform bg-white border-2 rounded-full cursor-pointer"
                                            :class="[show ? 'translate-x-full border-indigo-500' :
                                                'translate-x-0 border-gray-300'
                                            ]"></label>
                                        <input type="checkbox" name="show"
                                            class="hidden w-full h-full rounded-full appearance-none active:outline-none focus:outline-none" />
                                    </div>

                                    <p class="text-gray-500">Can delete task</p>
                                </div>

                                <div class="flex items-center space-x-3 cursor-pointer" x-data="{ show: true }"
                                    @click="show =!show">
                                    <div class="relative w-10 h-5 transition duration-200 ease-linear rounded-full"
                                        :class="[show ? 'bg-indigo-500' : 'bg-gray-300']">
                                        <label for="show" @click="show =!show"
                                            class="absolute left-0 w-5 h-5 mb-2 transition duration-100 ease-linear transform bg-white border-2 rounded-full cursor-pointer"
                                            :class="[show ? 'translate-x-full border-indigo-500' :
                                                'translate-x-0 border-gray-300'
                                            ]"></label>
                                        <input type="checkbox" name="show"
                                            class="hidden w-full h-full rounded-full appearance-none active:outline-none focus:outline-none" />
                                    </div>

                                    <p class="text-gray-500">Can edit task</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="button"
                                class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                Invite Member
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- <section>
        <div class="bg-white shadow-md rounded overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="font-bold text-xl mb-2">To-Do List</h2>
            </div>
            <ul class="px-6 py-4 divide-y divide-gray-200">
                <li class="flex items-center py-2">
                    <input type="checkbox" class="mr-2 focus:ring-0 rounded-sm">
                    <label for="task1" class="text-gray-700 text-base">Buy groceries</label>
                </li>
                <li class="flex items-center py-2">
                    <input type="checkbox" class="mr-2 focus:ring-0 rounded-sm">
                    <label for="task2" class="text-gray-700 text-base">Finish report</label>
                </li>
            </ul>
            <div class="px-6 py-4 flex justify-end">
                <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                    Task</button>
            </div>
        </div>

    </section> --}}





    <div x-data="{ open: false }">
        <button @click="open = true">Open Modal</button>

        <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto">
            <div
                class="flex items-center justify-center min-height-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span
                    class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">

                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Modal title
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam lectus,
                                        hendrerit id orci eget, tincidunt ultricies eros. Cras vehicula tincidunt lacus,
                                        a ultricies neque ultricies eget. Sed eu orci eu massa ultricies posuere. Donec
                                        id elit non mi porta gravida at eget metus.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6">
                            <button @click="open = false"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                            <button
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 ml-4 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:w-auto sm:text-sm">
                                Add
                            </button>
                        </div>
                    </div>
                </span>
            </div>
        </div>
    </div>









    <br>
    <br>
    <br>
    <br>
    <br>

    <div x-data="{ isOpen: false, inputValue: '' }">
        <button type="button" @click="isOpen = true"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Item</button>

        <div x-show="isOpen" @keydown.esc="isOpen = false"
            class="fixed inset-0 z-50 overflow-y-auto px-4 md:inset-auto md:flex md:flex-col md:items-center md:justify-center">
            <div class="bg-white rounded-lg shadow-md md:max-w-md">
                <div class="p-4">
                    <h5 class="text-xl font-bold leading-6 mb-3">Add New Item</h5>
                    <div class="mb-3">
                        <label for="item-input" class="block text-gray-700 font-bold mb-2">Item Name:</label>
                        <input type="text" id="item-input" x-model="inputValue"
                            class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="isOpen = false"
                            class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Close</button>
                        <button type="button" @click="addItem"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add</button>
                        <button type="button" @click="isOpen = false"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>















    <div x-data="{ showModal: false }">
        <button @click="showModal = true"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Buka Modal
        </button>

        <div x-show="showModal" class="fixed z-10 inset-0 overflow-y-auto">
            <div
                class="flex items-center justify-center min-height-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span class="inline-block align-middle h-screen text-center">
                    <div class="w-full max-w-md p-6 rounded-lg bg-white shadow-xl">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="text-xl font-bold text-gray-900">Modal Title</h5>
                            <button @click="showModal = false"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 ml-auto inline-flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit
                            amet pretium urna. Fusce ultricies purus eget ligula tempor, eget hendrerit nibh ultricies.
                            Donec eget lacus porta, vulputate risus eget, ultricies neque.</p>
                    </div>
                </span>
            </div>
        </div>
    </div>
</body>

</html>
