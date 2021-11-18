<div>
    <div>
        <div class="mt-2 border rounded-lg">
            <div class="flex items-center px-6 py-2 border-b">
                <div class="flex-grow text-lg font-semibold tracking-wide text-gray-900">
                    @switch($type)
                        @case(\App\Models\Requisition::$PREPARATION)
                        {{ __('تسخيرة عملية التحضير') }}
                        @break
                        @case(\App\Models\Requisition::$MANAGEMENT)
                        {{ __('تسخيرة عملية التسيير') }}
                        @break
                    @endswitch
                </div>
                <div class="flex gap-2">
                    @if($creating)
                        <button wire:click="save" class="px-2 py-1.5 text-indigo-500 border border-transparent rounded-lg hover:text-indigo-700 hover:border-indigo-700">
                            {{ __('حفظ التسخيرة') }}
                        </button>
                    @else
                        <button wire:click="startCreateRequisition" class="px-2 py-1.5 text-green-500 border border-transparent rounded-lg hover:text-green-700 hover:border-green-700">
                            {{ __('إظافة تسخيرة') }}
                        </button>
                    @endif
                </div>
            </div>
            <div class="flex items-center px-6 py-2">
                @if($creating)
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
                @endif
            </div>
        </div>
    </div>

</div>
