<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-row flex-wrap gap-2">
            <div class="text-gray-800 border border-light-blue-100 rounded-md py-1 px-3">
                <a href="{{ Route('create-note') }}" class="h-8">
                    <i class="fa-solid fa-plus text-sm"></i>
                    <span class="ms-1 text-sm">Add Note</span>
                </a>
            </div>
            <div class="w-40 lg:w-72">
                <form action="/notes" method="GET" id="search-form">
                    <div class="relative h-8 w-full min-w-[1px] flex items-center">
                        <label for="search-input" class="absolute right-3 h-full flex items-center justify-center">
                            <button type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </label>
                        <input type="text" value="{{ request('search-input') }}" placeholder="Search Note"
                            autocomplete="off" id="search-input" name="search-input"
                            class="h-full w-full rounded-[7px] !border !border-gray-300 border-t-transparent bg-transparent bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 shadow-lg shadow-gray-900/5 outline outline-0 ring-4 ring-transparent transition-all placeholder:text-gray-500 placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:!border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 focus:ring-gray-900/10 " />
                    </div>
                </form>
                <script>
                    const searchInput = document.getElementById('search-input');
                    const searchForm = document.getElementById('search-form');
                    console.log(searchForm);
                    // console.log(searchInput)
                    searchInput.addEventListener('input', function(e) {
                        console.log('changed');
                        console.log(searchInput.value);
                        e.preventDefault();
                        searchForm.submit();
                    });
                </script>
            </div>
        </div>
    </x-slot>

    <section class="mt-5">
        <div class="flex items-center justify-center gap-2 flex-wrap">
            @if (count($data) === 0)
                <div class="w-2/3 bg-white p-3 rounded-md shadow">
                    <div class="text-xl text-center text-gray-800 font-semibold">Empty</div>
                </div>
            @endif
            @foreach ($data as $row)
                <div class="w-full max-w-sm rounded-md shadow-md overflow-hidden">
                    <div
                        class="bg-white p-4 border border-b flex items-center justify-between gap-2 flex-row flex-wrap">
                        <div class="">
                            <h2 class="text-xl font-bold text-gray-800">{{ $row->judul }}</h2>
                        </div>
                        <div id="action" class="flex items-center justify-center gap-2 flex-row flex-wrap">
                            <div>
                                {{-- Edit --}}
                                <div x-data="{ isOpen{{ $row->id }}: false }" x-cloak>
                                    <!-- Trigger Button -->
                                    <i @click="isOpen{{ $row->id }} = true"
                                        class="fa-regular fa-pen-to-square text-orange-400 text-[18px] cursor-pointer"></i>
                                    <!-- Modal Background -->
                                    <div x-show="isOpen{{ $row->id }}"
                                        class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
                                        <!-- Modal Content -->
                                        <div
                                            class="bg-white w-[90%] max-w-lg px-6 py-4 mx-auto text-left rounded shadow-lg">
                                            <!-- Modal Header -->
                                            <div class="flex justify-between items-center pb-3 mb-3 border-b-2">
                                                <h2 class="text-xl font-bold">{{ $row->judul }}</h2>
                                                <button @click="isOpen{{ $row->id }} = false"
                                                    class="text-gray-500 hover:text-gray-700">
                                                    <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <form action="{{ route('update-note') }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <!-- Modal Body -->
                                                <div>
                                                    <div>
                                                        <label class="block mb-2 font-semibold"
                                                            for="content{{ $row->id }}">Title</label>
                                                        <input type="text" id="content{{ $row->id }}"
                                                            name="judul"
                                                            class="border rounded-lg px-3 py-2 mb-4 w-full"
                                                            value="{{ $row->judul }}" placeholder="Title">
                                                    </div>
                                                    <div>
                                                        <div class="text-xl font-medium mb-1">Content
                                                            <span class="text-sm font-semibold text-pink-400">*</span>
                                                        </div>
                                                        <input id="notes{{ $row->id }}" type="hidden"
                                                            name="note" value="{{ old('note', $row->note) }}">
                                                        <trix-editor input="notes{{ $row->id }}"
                                                            class="w-full h-64 lg:full md:h-auto overflow-y-auto"></trix-editor>
                                                    </div>
                                                    <input type="hidden" name="updateid" value="{{ $row->id }}">
                                                </div>
                                                <!-- Modal Footer -->
                                                <div class="flex justify-end gap-2 mt-3">
                                                    <button type="button" @click="isOpen{{ $row->id }} = false"
                                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400">Cancel</button>
                                                    <button type="submit"
                                                        class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400">Save</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                {{-- delete --}}
                                <div x-data="{ 'showModal{{ $row->id }}': false }" @keydown.escape="showModal{{ $row->id }} = false"
                                    x-cloak>
                                    <!-- Trigger for Modal -->
                                    <i @click="showModal{{ $row->id }} = true"
                                        class="fa-solid fa-trash text-pink-400 text-[18px] cursor-pointer"></i>
                                    <!-- Modal -->
                                    <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                        x-show="showModal{{ $row->id }}">
                                        <!-- Modal inner -->
                                        <div class="w-[90%] max-w-md px-6 py-4 mx-auto text-left bg-white rounded shadow-lg"
                                            @click.away="showModal{{ $row->id }} = false"
                                            x-transition:enter="motion-safe:ease-out duration-300"
                                            x-transition:enter-start="opacity-0 scale-90"
                                            x-transition:enter-end="opacity-100 scale-100">
                                            <!-- Title / Close-->
                                            <div class="p-5">
                                                <h3 class="mr-3 text-black text-xl max-w-none text-center">
                                                    Are you sure you want to delete
                                                    <span class="underline">{{ $row->judul }} ?</span>
                                                </h3>
                                            </div>
                                            <div class="flex items-center gap-2 justify-end mt-3">
                                                <button type="button"
                                                    class="z-50 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400"
                                                    @click="showModal{{ $row->id }} = false">Cancel</button>
                                                <form action="{{ Route('destroy-note') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $row->id }}">

                                                    <button type="submit"
                                                        class="z-50 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400 mr-1">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-white">
                        <div class="text-sm text-gray-700">{!! $row->note !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>




    {{-- <div class="w-full max-w-sm rounded-md shadow-md flex flex-row"> --}}
    {{-- <div id="parent">
        @foreach ($data as $row)
            <div class="flex flex-row items-center justify-center">
                <div>{{ $row->judul }}</div>
                <div>{!! $row->trimmedNote !!}</div>
            </div>
        @endforeach
    </div> --}}
    {{-- </div> --}}
    {{-- <div id="parent" class="flex flex-row">
        <div id="card">
            @foreach ($data as $row)
                <div>
                    Judul : <span>{{ $row->judul }}</span>
                </div>
                <div>Note : <span>{!! Str::limit($row->note, 5, '...') !!}</span></div>
            @endforeach
        </div>

    </div> --}}


    <script></script>



    {{-- add notes --}}
    {{-- <section class="flex justify-center mx-6 md:mx-6 sm:mx-6 lg:mx-12">
        <div
            class="bg-white border border-slate-500 rounded shadow-md overflow-hidden md:flex md:flex-col lg:flex lg:flex-col">
            <div class="px-6 py-4 bg-gray-200 rounded-t-md border-b border-slate-950">
                <div class="font-bold text-xl">Add Note</div>
            </div>
            <div class="mx-auto px-6 py-4 md:w-5/6 lg:w-full">
                <form x-data="{ notes: '' }" x-on:submit.prevent="addData" action="{{ route('add-note') }}"
                    method="POST">
                    @csrf
                    <div class="w-full">
                        <label for=""></label>
                        <input id="notes" type="hidden" name="notes" x-model="notes">
                        <trix-editor input="notes" class="w-full h-64 lg:full md:h-auto overflow-y-auto"></trix-editor>
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
                </form>
            </div>
            <div class="px-6 pt-4 pb-2 flex flex-wrap justify-start">

            </div>
        </div>

        </div>
    </section> --}}

</x-app-layout>
