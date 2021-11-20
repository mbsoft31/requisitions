<div>
    <section class="">
        <header class="divide-y">
            <div class="px-4 sm:px-6 py-8 sm:rounded-lg">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-semibold tracking-wide text-gray-900">
                        {{ __('قائمة التسخيرات') }}
                    </h1>
                    <button wire:click="$emit('openCreateForm')" class="px-4 py-2 text-gray-50 bg-green-600 rounded-md hover:text-white hover:bg-green-700">
                        {{ __('إضافة مسخر جديد') }}
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-12 items-center gap-4 px-4 sm:px-6 py-4 ">
                <div class="col-span-4 px-4 sm:px-6">

                </div>
                <div class="col-span-4 px-4 sm:px-6">

                    <div>
                        <input wire:model.debounce.500ms="search" id="search" type="text" placeholder="{{ __('بحث') }}" class="w-full rounded-lg">
                    </div>

                </div>
                <div class="col-span-4">
                    {{ $requisitions->links() }}
                </div>
            </div>
        </header>

        <main>
            <div class="flex flex-col">
                <div class="overflow-auto">
                    <div class="inline-block min-w-full">
                        <div class="overflow-hidden border-b border-gray-200">
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
                                        الرتبة
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-base font-semibold tracking-wide text-center text-gray-700 uppercase">
                                        المهام الموكلة إليه
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-base font-semibold tracking-wide text-center text-gray-700 uppercase">
                                        طباعة التسخيرة
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
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
                                            <div class="text-right">
                                                <div class="text-lg font-medium text-gray-900">
                                                    {{$person->first_name}} {{$person->last_name}}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{$person->birthdate}}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{$person->requisition_date}}
                                            </div>
                                        </td>
                                        <td class="px-6  py-4 ">
                                            <div class="text-sm text-gray-900">
{{--                                                todo : check this modification . class of the td tag : whitespace-nowrap --}}
{{--                                                {{$person->rank}}--}}
                                                {{\App\Models\Person::$ranks[$person->rank]}}
                                            </div>
                                        </td>
                                        <td  class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-right">
                                                @isset($person->management_requisition)
                                                    <div class="text-base font-semibold text-gray-900">
                                                        {{ __('التسيير') }}
                                                    </div>
                                                    <div class="text-sm text-gray-700">
                                                        {{ $person->management_requisition->destination }}
                                                    </div>
                                                    <div class="text-sm text-gray-700">
                                                        {{ $person->management_requisition->authorized_tasks }}
                                                    </div>
                                                @endisset
                                            </div>
                                            <div class="text-right">
                                                @isset($person->preparation_requisition)
                                                    <div class="text-base font-semibold text-gray-900">
                                                        {{ __('التحضير') }}
                                                    </div>
                                                    <div class="text-sm text-gray-700">
                                                        {{ $person->preparation_requisition->destination }}
                                                    </div>
                                                    <div class="text-sm text-gray-700">
                                                        {{ $person->preparation_requisition->authorized_tasks }}
                                                    </div>
                                                @endisset
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <div class="inline-flex bg-green-600 text-white rounded-lg overflow-hidden">
                                                @if($person->has_preparation)
                                                    <a wire:click="$emit('downloadDocument',[{{$person->preparation_requisition->id}}])" class="px-4 hover:bg-green-700 hover:border-green-700">
                                                        <span>التحضير</span>
                                                    </a>
                                                    <a wire:click="deleteRequisition({{$person->preparation_requisition->id}})" class="px-2 hover:bg-red-500 hover:border-red-500">
                                                        <span>&times;</span>
                                                    </a>
                                                @endif
                                            </div>

                                            <div class="inline-flex bg-green-600 text-white rounded-lg overflow-hidden">
                                                @if($person->has_management)
                                                    <a wire:click="$emit('downloadDocument',[{{$person->management_requisition->id}}])" class="px-4 hover:bg-green-700 hover:border-green-700">
                                                        <span>التسيير</span>
                                                    </a>
                                                    <a wire:click="deleteRequisition({{$person->management_requisition->id}})" class="px-2 hover:bg-red-500 hover:border-red-500">
                                                        <span>&times;</span>
                                                    </a>
                                                @endif
                                            </div>

                                        </td>
                                        <td class="px-6 py-4 space-x-3 text-lg font-medium text-right whitespace-nowrap">
                                            <button wire:click="$emit('openEditForm', {{$person}})" type="button" href="#" class="inline-block px-3 py-1 text-green-600 bg-green-100 border border-green-300 rounded-lg hover:bg-green-200 hover:text-green-900 hover:border-green-600">
                                                نعديل
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="px-6 py-8 text-xl font-semibold text-gray-700">
                                                التسخيرات غير موجودة
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        {{--<footer>

        </footer>--}}
    </section>
</div>
