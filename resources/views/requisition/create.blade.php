<div>
    <div>
        <div class="mt-2 border rounded-lg overflow-hidden">
            <div class="flex items-center px-6 py-2 border-b {{ ($type == \App\Models\Requisition::$PREPARATION) ? 'bg-green-200' : 'bg-blue-200' }}">
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
                        <button wire:click="startCreateRequisition" class="px-2 py-1.5 text-green-900 border border-transparent rounded-lg hover:text-green-900 hover:border-green-900">
                            {{ __('إظافة تسخيرة') }}
                        </button>
                    @endif
                </div>
            </div>
            <div class="flex items-center px-6 py-2">
                @if($creating)
                    <div class="grid grid-cols-12 gap-x-4 gap-y-6">
                        <div class="col-span-7 space-y-2">
                            <label class="block font-semibold">
                                {{ __('الجهة المرسلة') }}
                            </label>
                            <input autocomplete="expeditor" wire:model="state.expeditor" id="expeditor" name="expeditor" type="text" placeholder="destination" class="w-full rounded-md">
                        </div>

                        <div class="col-span-2 space-y-2">
                            <label class="block font-semibold">
                                {{ __('رقم الإرسالية') }}
                            </label>
                            <input autocomplete="invoice_number" wire:model="state.invoice_number" id="invoice_number" name="invoice_number" type="number" placeholder="destination" class="w-full rounded-md">
                        </div>

                        <div class="col-span-3 space-y-2">
                            <label class="block font-semibold">
                                {{ __('تاريخ الإرسالية') }}
                            </label>
                            <input autocomplete="invoice_date" wire:model="state.invoice_date" id="invoice_date" name="invoice_date" type="date" placeholder="destination" class="w-full rounded-md">
                        </div>

                        <div class="col-span-6 space-y-2">
                            <label class="block font-semibold">
                                {{ __('مكان التسخير') }}
                            </label>
                            <input autocomplete="destination" wire:model="state.destination" id="destination" name="destination" type="text" placeholder="destination" class="w-full rounded-md">
                        </div>

                        <div class="col-span-6 space-y-2">
                            <label class="block font-semibold">
                                {{ __('مهمة التسخير') }}
                            </label>
                            <input autocomplete="authorized_tasks" wire:model="state.authorized_tasks" id="authorized_tasks" name="authorized_tasks" type="text" placeholder="authorized_tasks" class="w-full rounded-md">
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
