<div>


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

                    <section class="px-6 py-8">
                        <div>
                            <!-- This example requires Tailwind CSS v2.0+ -->
                            <div class="flex flex-col">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                            <table class="min-w-full text-center divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-base font-semibold tracking-wide text-center text-gray-700 uppercase">
                                                        الرقم
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-base font-semibold tracking-wide text-center text-gray-700 uppercase">
                                                        الإسم واللقب
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-base font-semibold tracking-wide text-center text-gray-700 uppercase">
                                                        تاريخ التسخير
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-base font-semibold tracking-wide text-center text-gray-700 uppercase">
                                                        طباعة التسخيرة
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-base font-semibold tracking-wide text-center text-gray-700 uppercase">
                                                        الرتبة
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-base font-semibold tracking-wide text-center text-gray-700 uppercase">
                                                        المهام الموكلة إليه
                                                    </th>
                                                    <th scope="col" class="relative px-6 py-3">
                                                        <span class="sr-only">Edit</span>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                @forelse($persons as $person)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            {{$person->id}}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <div class="mr-0">
                                                                    <div class="text-lg font-medium text-gray-900">
                                                                        {{$person->first_name}} {{$person->last_name}}
                                                                    </div>
                                                                    <div class="text-sm text-gray-500">
                                                                        {{$person->birthdate}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm text-gray-900">
                                                                {{$person->requisition_date}}
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            @if($person->has_preparation)
                                                                <div class="inline-flex space-x-2 overflow-hidden bg-green-200 rounded-lg">
                                                                    <a href="#" class="px-2 rounded-r-lg hover:bg-green-300">
                                                                        <span>التحضير</span>
                                                                    </a>
                                                                    <a href="#" class="px-2 text-white bg-green-200 rounded-l-lg hover:bg-red-300">
                                                                        <span>&times;</span>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                            @if($person->has_management)
                                                                <div class="inline-flex space-x-2 overflow-hidden bg-green-200 rounded-lg">
                                                                    <a href="#" class="px-2 rounded-r-lg hover:bg-green-300">
                                                                        <span>التسيير</span>
                                                                    </a>
                                                                    <a href="#" class="px-2 text-white bg-green-200 rounded-l-lg hover:bg-red-300">
                                                                        <span>&times;</span>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm text-gray-900">
                                                                {{$person->rank}}
                                                            </div>
                                                        </td>
                                                        <td  class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap text:right">
                                                            @if($person->management_requisition)
                                                                التسيير:{{$person->management_requisition->authorized_tasks}}
                                                            @endif
                                                            <br>
                                                            @if($person->preparation_requisition)
                                                                التحضير:{{$person->preparation_requisition->authorized_tasks}}
                                                            @endif
                                                        </td>
                                                        <td class="px-6 py-4 space-x-3 text-lg font-medium text-right whitespace-nowrap">
                                                            <a  href="#" class="inline-block px-3 py-1 text-green-600 bg-green-100 border border-green-300 rounded-lg hover:bg-green-200 hover:text-green-900 hover:border-green-600">
                                                                نعديل
                                                            </a>
                                                            <form action="#" method="post"  class="inline-block px-3 py-1 text-red-600 bg-red-100 border border-red-300 rounded-lg hover:bg-red-200 hover:text-red-900 hover:border-red-600">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" >
                                                                    حذف
                                                                </button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7">
                                                            <div class="px-6 py-8 text-xl font-semibold text-gray-700">
                                                                لم يتم اظافة تسخيرات بعد
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                                <!-- More people... -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white px-6 py-4 sm:-mx-6 lg:-mx-8 mt-4 rounded-lg shadow">
                                {{ $persons->links() }}
                            </div>
                        </div>
                    </section>
                    <footer class="px-6 py-4 rounded-b-lg">
                    </footer>
                </main>
            </div>
        </div>
    </div>

</div>
