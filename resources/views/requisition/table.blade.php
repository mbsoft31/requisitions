<div>
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
                        @forelse($requisitions as $person)
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
                                        لم يتم اضافة تسخيرات بعد
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
        {{ $requisitions->links() }}
    </div>
</div>
