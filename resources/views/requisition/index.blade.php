<div>


    @livewire('person.create')


    <div>
        @if($errors->first())
            <div class="fixed top-0 left-0 flex items-center justify-center w-1/6 py-6 m-4 text-red-500 bg-opacity-25 shadow-md rounded-xl z-80">
                <svg class="w-8 h-8 text-red-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M8 13.5v-8a1.5 1.5 0 0 1 3 0v6.5m0 -6.5v-2a1.5 1.5 0 0 1 3 0v8.5m0 -6.5a1.5 1.5 0 0 1 3 0v6.5m0 -4.5a1.5 1.5 0 0 1 3 0v8.5a6 6 0 0 1 -6 6h-2a7 6 0 0 1 -5 -3l-2.7 -5.25a1.4 1.4 0 0 1 2.75 -2l.9 1.75" /></svg>
                <span class="px-2">{{$errors->first()}}</span>
            </div>
        @endif
        <div data-theme="corporate" dir="rtl" class="flex justify-center bg-gray-100 ">
            <div x-data="{show_create_form: false, show_excel_import: false, show_excel_export: false, rank: [1, 2, 3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]}" class="w-full mx-auto text-gray-800 max-w-7xl">
                <aside>
                    <div x-show="$store.aside.show_create_form" class="fixed inset-y-0 right-0 w-full bg-black bg-opacity-25">
                        <div class="w-full h-full max-w-5xl bg-white mw-auto">
                            <main class="max-w-5xl mx-auto bg-white rounded-b-lg">
                                <header class="overflow-hidden rounded-t-lg bg-gray-50">
                                    <div class="flex items-center justify-between px-6 py-4 space-x-4">
                                        <div class="flex-grow">
                                            <h1 class="text-xl font-semibold tracking-wide text-gray-700">
                                                إضافة مسخر جديد
                                            </h1>
                                        </div>
                                        <button x-on:click="$store.aside.toggle_show_create_form()" class="block px-4 py-4 text-lg font-semibold text-center bg-red-400 border rounded-lg hover:bg-red-500 text-gray-50 hover:text-gray-50 ">
                                            غلق
                                        </button>
                                    </div>
                                </header>
                                <div class="min-h-full overflow-y-auto">

                                </div>
                            </main>
                        </div>
                    </div>
                    <div x-show="$store.aside.show_excel_import" class="fixed inset-y-0 right-0 w-full bg-black bg-opacity-25">
                        <div class="w-full h-full max-w-3xl bg-white mw-auto">
                            <main class="max-w-3xl mx-auto bg-white rounded-b-lg">
                                <header class="overflow-hidden rounded-t-lg bg-gray-50">
                                    <div class="flex items-center justify-between px-6 py-4 space-x-4">
                                        <div class="flex-grow">
                                            <h1 class="text-xl font-semibold tracking-wide text-gray-700">
                                                تحميل المسخرين من ملف EXCEL
                                            </h1>
                                        </div>
                                        <button x-on:click="show_excel_import = false" class="block px-4 py-4 text-lg font-semibold text-center text-gray-700 border rounded-lg hover:bg-gray-100 hover:text-gray-900">
                                            غلق
                                        </button>
                                    </div>
                                </header>
                                <div class="">
                                    <form  method="post" class="flex flex-col justify-between space-y-8 items-between" enctype="multipart/form-data">
                                        @csrf

                                        <div class="flex items-center justify-center bg-grey-lighter">
                                            <label class="flex flex-col items-center w-64 px-4 py-6 tracking-wide text-indigo-500 uppercase border rounded-lg shadow-lg cursor-pointer bg-gray-50 ring-2 ring-indigo-500 text-blue border-blue hover:bg-indigo-500 hover:text-white">
                                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                                </svg>
                                                <span class="mt-2 text-base leading-normal">Select a file</span>
                                                <input type="file" name="file" id="file_input" class="hidden">
                                            </label>
                                        </div>
                                        <div class="flex items-center justify-end px-6 py-4">
                                            <button type="submit" class="px-4 py-2 bg-green-400 border rounded-md text-gray-50 hover:text-white hover:bg-green-500">
                                                حفظ المعلومات
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </main>
                        </div>
                    </div>
                </aside>
                <main class="mx-auto max-w-7xl">

                    <section>
                        <div class="bottom-0 left-0 flex items-center justify-end px-6 py-4 bg-gray-50">
                            <button wire:click="$emit('openCreateForm')" class="px-4 py-2 bg-green-600 border rounded-md text-gray-50 hover:text-white hover:bg-green-700">
                                إضافة مسخر جديد
                            </button>
                        </div>
                    </section>

                    <section class="px-6 py-8">
                        <div>

                            @livewire('requisition.table')


                        </div>
                    </section>
                    <footer class="px-6 py-4 rounded-b-lg">
                    </footer>
                </main>
            </div>
        </div>
    </div>

</div>
