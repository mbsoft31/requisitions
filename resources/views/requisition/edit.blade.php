<div>
    <div class="mt-2 border rounded-lg">
        <div class="flex items-center px-6 py-2 border-b">
            <div class="flex-grow text-lg font-semibold tracking-wide text-gray-900">
                @switch($requisition->type)
                    @case(\App\Models\Requisition::$PREPARATION)
                    {{ __('تسخيرة عملية التحضير') }}
                    @break
                    @case(\App\Models\Requisition::$MANAGEMENT)
                    {{ __('تسخيرة عملية التسيير') }}
                    @break
                @endswitch

                @if($requisition->printed_by)
                    <span class="text-xs font-extralight text-gray-500">
                        <span>تمت الطباعة من طرف المستخدم :</span>
                        <span>{{\App\Models\User::find($requisition->printed_by)->name}}</span>
                    </span>
                @endif
            </div>
            <div class="flex gap-2">
                @if($editing)
                    <button wire:click="save({{$requisition->id}})" class="px-2 py-1.5 text-indigo-500 border border-transparent rounded-lg hover:text-indigo-700 hover:border-indigo-700">
                        {{ __('حفظ التسخيرة') }}
                    </button>
                @else
                    <button wire:click="startEditRequisition({{$requisition->id}})" class="px-2 py-1.5 text-green-500 border border-transparent rounded-lg hover:text-green-700 hover:border-green-700">
                        {{ __('تعديل التسخيرة') }}
                    </button>
                    <button wire:click="$emit('deleteRequisition', {{$requisition}})" class="px-2 py-1.5 text-red-500 border border-transparent rounded-lg hover:text-red-700 hover:border-red-700">
                        {{ __('إلغاء التسخيرة') }}
                    </button>
                @endif
            </div>
        </div>
        <div class="flex items-center px-6 py-2">
            @if($editing)
                <div class="grid grid-cols-12 gap-x-4 gap-y-6">
                <div class="col-span-6 space-y-2">
                    <label class="block font-semibold">
                        {{ __('مكان التسخير') }}
                    </label>
                    <input wire:model="state.destination" id="destination" type="text" placeholder="destination" class="w-full rounded-md">
                </div>

                <div class="col-span-6 space-y-2">
                    <label class="block font-semibold">
                        {{ __('مهمة التسخير') }}
                    </label>
                    <input wire:model="state.authorized_tasks" id="authorized_tasks" type="text" placeholder="authorized_tasks" class="w-full rounded-md">
                </div>
            </div>
            @else
                <div class="flex-grow">
                <div>
                    <p class=" font-semibold tracking-wide text-gray-700">{{ __('مكان التسخير') }}</p>
                    <p class="text-gray-600">{{ $requisition->destination }}</p>
                </div>
                <div>
                    <p class=" font-semibold tracking-wide text-gray-700">{{ __('مهمة التسخير') }}</p>
                    <p class="text-gray-600">{{ $requisition->authorized_tasks }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
