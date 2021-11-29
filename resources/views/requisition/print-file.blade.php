<div x-data >
    <div x-show='$wire.show' class="fixed right-0 inset-y-0 w-full bg-black bg-opacity-25">
        <div class="flex flex-col w-full h-full max-w-3xl bg-white">
            <header class="bg-gray-50 rounded-t-lg overflow-hidden">

                <div class="flex items-center justify-between px-6 py-4 space-x-4">
                    <div class="flex-grow">
                        <h1 class="text-xl font-semibold tracking-wide text-gray-700">
                            {{__("Advanced Printing")}}
                        </h1>
                    </div>

                    <button wire:click="closePrintForm" class="block text-center px-4 py-2 text-lg font-semibold rounded-lg hover:border text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                        <svg class="text-gray-500 w-4 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg>
                    </button>
                </div>

            </header>
            <main class="flex-grow divide-y overflow-y-auto">

                <div class="">
                    <div class="flex flex-col divide-y">
                        <div class="space-y-2 px-4">
                            <label class="block font-semibold">
                                {{ __('تحميل حسب الهيئة المستخدمة') }}
                            </label>
                            <select wire:model="commission" id="commission" class="w-full rounded-md">
                                <option value="all" selected>اختيار جميع التسخيرات</option>
                                @foreach($commissions as $key => $value)
                                    <option value="{{$value}}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="flex items-center justify-end px-6 py-4 bg-gray-50">
                <button wire:click="print" type="button" class="px-4 py-2 bg-gray-600 border rounded-md text-gray-50 hover:text-white hover:bg-gray-700">
                    تحميل
                </button>
            </footer>
        </div>

    </div>

</div>

