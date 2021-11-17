<div x-data="{show_create_form: @entangle('show')}">

    <div x-show="show_create_form" class="fixed inset-y-0 right-0 w-full bg-black z-50 bg-opacity-25">
        <div class="w-full h-full max-w-3xl bg-white mw-auto">
            <main class="max-w-5xl mx-auto bg-white rounded-b-lg">
                <header class="overflow-hidden rounded-t-lg bg-gray-50">
                    <div class="flex items-center justify-between px-6 py-4 space-x-4">
                        <div class="flex-grow">
                            <h1 class="text-xl font-semibold tracking-wide text-gray-700">
                                إضافة مسخر جديد
                            </h1>
                        </div>
                        <button wire:click="closeCreateForm" class="block px-4 py-4 text-lg font-semibold text-center bg-red-400 border rounded-lg hover:bg-red-500 text-gray-50 hover:text-gray-50 ">
                            غلق
                        </button>
                    </div>
                </header>
                <div class="min-h-full overflow-y-auto">
                    <form action="#" method="post" class="h-screen form-control">
                        @csrf
                        <div class="flex flex-col overflow-y-auto divide-y">
                            <div class="px-6 py-8 space-y-4">
                                <div class="grid grid-cols-12 gap-2 items-center">
                                    <div class="col-span-6 flex justify-end overflow-hidden">
                                        <label class="flex items-center justify-center w-28 font-semibold rounded-r-md text-white bg-indigo-500">الإسم</label>
                                        <input name="first_name" id="first_name" type="text" placeholder="الإسم" class="flex-grow rounded-l-md">
                                    </div>
                                    <div class="col-span-6 flex justify-end">
                                        <label class="flex items-center justify-center w-28 font-semibold rounded-r-md text-white bg-indigo-500">اللقب</label>
                                        <input name="last_name" id="last_name" type="text" placeholder="اللقب" class="flex-grow rounded-l-md">
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-2 items-center">
                                    <div class="col-span-6 flex justify-end">
                                        <label class="flex items-center justify-center w-28 font-semibold rounded-r-md text-white bg-indigo-500">تاريخ الميلاد</label>
                                        <input name="date_of_birth" class="flex-grow rounded-l-md" type="date" id="birthdate">
                                    </div>
                                    <div class="col-span-6 flex justify-end">
                                        <label class="flex items-center justify-center w-28 font-semibold rounded-r-md text-white bg-indigo-500">مكان الميلاد</label>
                                        <input name="location_of_birth" class="flex-grow rounded-l-md" type="text" id="birth_place"  >
                                    </div>
                                </div>

                                <div class="grid grid-cols-12 gap-2 items-center">
                                    <div class="col-span-6 flex justify-end">
                                        <label class="flex items-center justify-center w-28 font-semibold rounded-r-md text-white bg-indigo-500">الوظيفة الأصلية</label>
                                        <input name="original_job" class="flex-grow rounded-l-md" type="text" id="last_name">
                                    </div>
                                    <div class="col-span-6 flex justify-end">
                                        <label class="flex items-center justify-center w-28 font-semibold rounded-r-md text-white bg-indigo-500">الرتبة</label>
                                        <select name="rank" id="cid_type" class="flex-grow rounded-l-md">
                                            @foreach($ranks as $key => $value)
                                                <option value="{{$key}}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-2 items-center">
                                    <div class="col-span-6 flex justify-end">
                                        <label class="flex items-center justify-center w-28 font-semibold rounded-r-md text-white bg-indigo-500">الهيئة المستخدمة</label>
                                        <input name="commission" class="flex-grow rounded-l-md" type="text" >
                                    </div>
                                    <div class="col-span-6 flex justify-end">
                                        <label class="flex items-center justify-center w-28 font-semibold rounded-r-md text-white bg-indigo-500">تاريخ التسخيرة</label>
                                        <input name="requisition_date" class="flex-grow rounded-l-md" type="date" id="birthdate">
                                    </div>
                                </div>
                            </div>
                            <div class="shadow-lg my-2 ring-gray-100 p-2 collapse w-full border bg-white focus:bg-red-200 rounded-box border-base-300 collapse-plus">
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
                            </div>

                        </div>
                        <div class="bottom-0 left-0 flex items-center justify-end px-6 py-4  mb-36 bg-gray-50">
                            <button type="submit" class="px-4 py-2 bg-gray-600 border rounded-md text-gray-50 hover:text-white hover:bg-green-700">
                                حفظ المعلومات
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

</div>
