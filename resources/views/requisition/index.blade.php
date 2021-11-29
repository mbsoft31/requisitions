<div>

    <div>
        @livewire('person.create')
    </div>

    <div>
        @livewire('person.edit')
    </div>

    @can("delete person")
        <div>
            @livewire('person.delete')
        </div>
    @endcan

    <div >
        @livewire('requisition.upload-file')
    </div>

    <div >
        @livewire('requisition.print-file')
    </div>

    <div class="py-6 w-10/12 mx-auto">
        @livewire('requisition.table')
    </div>

    @push("scripts")
        <script>
            window.addEventListener("keydown",  function(event) {
                if (event.key === "+") {
                    Livewire.emit('openCreateForm');
                }
            });
        </script>
    @endpush

</div>
