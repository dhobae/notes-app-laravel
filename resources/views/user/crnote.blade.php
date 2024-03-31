<x-app-layout>
    <section class="flex justify-center mt-6 lg:mt-24 mx-6 md:mx-6 sm:mx-6 lg:mx-12">
        <div
            class="bg-white border border-slate-500 rounded shadow-md overflow-hidden md:flex md:flex-col lg:flex lg:flex-col">
            <div class="px-6 py-4 bg-gray-200 rounded-t-md border-b border-slate-950">
                <div class="font-bold text-xl">Add Note</div>
            </div>
            <form action="{{ Route('store-note') }}" method="POST">
                @csrf
                <div class="mx-auto px-6 py-4 md:w-5/6 lg:w-full">
                    <div class="w-full">
                        <div class="mb-3">
                            <label for="name" class="text-xl font-medium">Title
                                <span class="text-sm font-semibold text-pink-400">*</span>
                            </label>

                            <input type="text" id="name" name="judul" autocomplete="off"
                                placeholder="How Make Lumpia"
                                class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 w-full">
                        </div>
                        <div>
                            <div class="text-xl font-medium mb-1">Content
                                <span class="text-sm font-semibold text-pink-400">*</span>
                            </div>
                            <input id="notes" type="hidden" name="note" x-model="note">
                            <trix-editor input="notes"
                                class="w-full h-64 lg:full md:h-auto overflow-y-auto"></trix-editor>
                        </div>
                    </div>

                    <div class="flex justify-end mt-5 gap-2">

                        <button type="submit"
                            class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                            type="button">
                            Add
                        </button>
                        <a href="{{ Route('index') }}"
                            class="select-none rounded-lg border border-gray-900 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
            {{-- <div class="px-6 pt-4 pb-2 flex flex-wrap justify-start">

            </div> --}}
        </div>
    </section>




</x-app-layout>
