<div x-data="{show_create_form: @entangle('show')}">

    <div x-show="show_create_form" class="fixed inset-y-0 right-0 w-full bg-black z-50 bg-opacity-25" style="display: none">
        <div class="flex flex-col w-full h-full max-w-3xl bg-white">

            <header class="flex items-center justify-between px-6 py-4 space-x-4 overflow-hidden rounded-b-lg bg-gray-50">
                <h1 class="flex-grow text-xl font-semibold tracking-wide text-gray-700">
                    إضافة مسخر جديد
                </h1>
                <button wire:click="closeCreateForm" class="block px-2 py-1 border border-transparent rounded-lg hover:border-gray-300">
                    <svg class="text-gray-500 w-4 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"/></svg>
                </button>
            </header>

            <main class="flex-grow">
                <form action="#" method="post" class="">
                    @csrf
                    <div class="flex flex-col divide-y">

                        <div class="grid grid-cols-12 gap-x-4 gap-y-6 px-6 py-8">

                            <div class="col-span-6 space-y-2">
                                <label class="block font-semibold">
                                    {{ __('الإسم') }}
                                </label>
                                <input wire:model="state.first_name" id="first_name" type="text" placeholder="الإسم" class="w-full rounded-md">
                            </div>

                            <div class="col-span-6 space-y-2">
                                <label class="block font-semibold">
                                    {{ __('اللقب') }}
                                </label>
                                <input wire:model="state.last_name" id="last_name" type="text" placeholder="اللقب" class="w-full rounded-md">
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

                        {{--<div class="shadow-lg my-2 ring-gray-100 p-2 collapse w-full border bg-white focus:bg-red-200 rounded-box border-base-300 collapse-plus">
                            <input type="checkbox" checked>
                            <div class="text-2xl text-right collapse-title ">
                                تسخيرة التحضير
                            </div>
                            <div class="collapse-content">
                                <div class="flex items-center space-x-2 gap-x-2">
                                    <label  class="flex-row-reverse justify-end input-group ">
                                        <input name="preparation[authorized_tasks]" class="flex-grow input input-bordered" type="text"  >
                                        <span class="flex justify-center font-semibold text-white bg-indigo-500 w-36 whitespace-nowrap">المهام الموكلة إليه</span>
                                    </label>
                                    <label  class="flex-row-reverse justify-end input-group ">
                                        <input name="preparation[requisition_destination]" class="flex-grow input input-bordered" type="text" id="first_name"  >
                                        <span class="flex justify-center font-semibold text-white bg-indigo-500 w-36 whitespace-nowrap">الجهة المسخر فيها</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="shadow-lg my-2 ring-gray-100 p-2 collapse w-full border bg-white focus:bg-red-200 rounded-box border-base-300 collapse-plus">
                            <input type="checkbox" checked>
                            <div class="text-2xl text-right collapse-title ">
                                تسخيرة التسيير
                            </div>
                            <div class="collapse-content">
                                <div class="flex items-center space-x-2 gap-x-2">
                                    <label  class="flex-row-reverse justify-end input-group ">
                                        <input name="management[authorized_tasks]" class="flex-grow input input-bordered" type="text" id="last_name"  >
                                        <span class="flex justify-center font-semibold text-white bg-indigo-500 w-36 whitespace-nowrap">المهام الموكلة إليه</span>
                                    </label>
                                    <label  class="flex-row-reverse justify-end input-group ">
                                        <input name="management[requisition_destination]" class="flex-grow input input-bordered" type="text" id="first_name"  >
                                        <span class="flex justify-center font-semibold text-white bg-indigo-500 w-36 whitespace-nowrap">الجهة المسخر فيها</span>
                                    </label>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                </form>
                <div>
                    <div class="px-6 flex flex-col">
                        @foreach($requisitions as $type=>$requisition)
                            @if($requisition)
                                @livewire("requisition.edit", ["requisition" => $requisition], key($type.'edit'))
                            @else
                                @livewire("requisition.create", ["type" => $type], key($type.'create'))
                            @endif
                        @endforeach
                    </div>
                </div>
            </main>

            <footer class="flex items-center justify-end px-6 py-4 bg-gray-50">
                <button wire:click="store" type="button" class="px-4 py-2 bg-gray-600 border rounded-md text-gray-50 hover:text-white hover:bg-gray-700">
                    حفظ المعلومات
                </button>
            </footer>
        </div>
    </div>

</div>
