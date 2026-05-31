<div x-data="{show_edit_form: @entangle('show')}">

    <div x-show="show_edit_form" class="fixed inset-y-0 right-0 w-full bg-black z-50 bg-opacity-25" style="display: none">
        <div class="flex flex-col w-full h-full max-w-3xl bg-white">

            <header class="flex items-center justify-between px-6 py-2 space-x-4 overflow-hidden rounded-b-lg bg-gray-50">
                <h1 class="flex-grow text-xl font-semibold tracking-wide text-gray-700">
                    {{ __('تعديل المسخر') }}
                </h1>
                <button wire:click="closeEditForm" class="block px-2 py-1 border border-transparent rounded-lg hover:border-gray-300">
                    <svg class="text-gray-500 w-4 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"/></svg>
                </button>
            </header>

            <main class="flex-grow divide-y overflow-y-scroll">
                <form action="#" method="post" class="f">
                    @csrf
                    <div class="flex flex-col divide-y">

                        <div class="grid grid-cols-12 gap-x-4 gap-y-6 px-6 py-6">
                            <div class="col-span-6 space-y-2">
                                <label class="block font-semibold">
                                    {{ __('اللقب') }}
                                </label>
                                <input wire:model="state.last_name" id="last_name" type="text" placeholder="اللقب" class="w-full rounded-md">
                            </div>
                            <div class="col-span-6 space-y-2">
                                <label class="block font-semibold">
                                    {{ __('الإسم') }}
                                </label>
                                <input wire:model="state.first_name" id="first_name" type="text" placeholder="الإسم" class="w-full rounded-md">
                            </div>
                            <div class="col-span-6 space-y-2">
                                <label class="block font-semibold">
                                    {{ __('تاريخ الميلاد') }}
                                </label>
                                <input wire:model="state.birthdate" id="birthdate" type="date" class="w-full rounded-md">
                            </div>

                            <div class="col-span-6 space-y-2">
                                <label class="block font-semibold">
                                    {{ __('مكان الميلاد') }}
                                </label>
                                <input wire:model="state.birth_place" id="birth_place" type="text" class="w-full rounded-md">
                            </div>

                            <div class="col-span-6 space-y-2">
                                <label class="block font-semibold">
                                    {{ __('الوظيفة الأصلية') }}
                                </label>
                                <input wire:model="state.original_job" id="last_name" type="text" class="w-full rounded-md">
                            </div>

                            <div class="col-span-6 space-y-2">
                                <label class="block font-semibold">
                                    {{ __('الرتبة') }}
                                </label>
                                <select wire:model="state.rank" id="rank" class="w-full rounded-md">
                                    @foreach($ranks as $key => $value)
                                        <option value="{{$key}}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-6 space-y-2">
                                <label class="block font-semibold">
                                    {{ __('الهيئة المستخدمة') }}
                                </label>
                                <input wire:model="state.commission" id="commission" type="text"  class="w-full rounded-md">
                            </div>

                            <div class="col-span-6 space-y-2">
                                <label class="block font-semibold">
                                    {{ __('تاريخ التسخيرة') }}
                                </label>
                                <input wire:model="state.requisition_date" id="requisition_date" type="date" class="w-full rounded-md">
                            </div>

                        </div>
                    </div>
                </form>
                @isset($person)
                    <div>
                        <div class="px-6 flex flex-col">
                            @foreach($types as $type=>$requisition)
                                @if($person->$requisition)
                                    @livewire("requisition.edit", ["requisition" => $person->$requisition], key($type.'edit'))
                                @else
                                    @livewire("requisition.create", ["type" => $type], key($type.'create'))
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endisset
            </main>

            <footer class="flex items-center justify-end px-6 py-4 bg-gray-50">
                <button wire:click="save" type="button" class="px-4 py-2 bg-gray-600 border rounded-md text-gray-50 hover:text-white hover:bg-gray-700">
                    حفظ المعلومات
                </button>
            </footer>
        </div>
    </div>

</div>
