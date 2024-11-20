<x-dashboard.super-admin.base>


    <x-notification-message />

    <x-dashboard.page-label :back_url="route('super-admin.master-list.index')" title="masterList" />

    <div class="panel p-2">
        <div class="flex gap-2">
            <div class="w-1/5 flex  flex-col gap-2">
                <img src="{{ $masterList->image }}" alt="" srcset="" class="w-full h-64 object-cover">
                <h1 class="text-center text-lg font-bold capitalize text-primary">
                    {{ "{$masterList->last_name}, {$masterList->first_name}" }}
                </h1>
                <h1 class="text-center text-xs font-semibold text-gray-500">
                    {{ $masterList->email }}
                </h1>
            </div>
            <div class="w-5/6 min-h-32 bg-gray-50 rounded-lg p-2">


                    <h1 class="text-xl font-bold text-primary capitalize">
                        Personal Information
                    </h1>

                    <!-- You can open the modal using ID.showModal() method -->




                <div class="grid grid-cols-3 grid-flow-row gap-5">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Last Name</h1>
                        <p>{{ $masterList->last_name }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">First Name</h1>
                        <p>{{ $masterList->first_name }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Middle Name</h1>
                        <p>{{ $masterList->middle_name ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Unit Number</h1>
                        <p>{{ $masterList->room_number ?? 'N\A' }}</p>
                    </div>
                    {{-- <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Move in Date</h1>
                        <p>{{ date('F d, Y', strtotime($masterList->masterList->move_in_date)) }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Tenement</h1>
                        <p>{{ $masterList->masterList->room->tenement->name ?? 'N\A' }}</p>
                    </div> --}}
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Gender</h1>
                        <p>{{ $masterList->gender ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Contact</h1>
                        <p>{{ $masterList->contact_no ?? 'N\A' }}</p>
                    </div>
                </div>




            </div>

        </div>
    </div>
</x-dashboard.super-admin.base>
