<x-dashboard.tenant.base>


    <div class="w-full h-64 rounded-lg bg-center bg-no-repeat bg-cover relative"
        style="background-image: url({{ $tenement->image }});">
        <div class="absolute z-10 backdrop-blur-sm flex w-full h-full justify-center items-center">
            <div class="flex  flex-col gap-2">
                <h1 class="text-2xl font-bold text-primary text-center">{{ $tenement->name }}</h1>
                <p class="text-lg text-center">{{ $room->room_number }}</p>
            </div>

        </div>
    </div>

    <div class="grid grid-cols-3 grid-flow-row gap-2">
        <x-card icon="fi fi-rr-file-invoice-dollar" :hasCurrency="true" label="Monthly Amortization Bills"
         :total="$totalAmortizationBill" />
        <x-card icon="fi fi-rr-file-invoice-dollar" :hasCurrency="true" label="Monthly Dues
Bills"  :total="$totalMonthlyDuesBill" />
        <x-card icon="fi fi-rr-megaphone" label="Announcement" :total="$totalAnnouncement" />
        <x-card icon="i fi-rr-file-invoice-dollar" label="Total Ammortilization" :hasCurrency="true" :total="$totalAmortization" />
        <x-card icon="i fi-rr-file-invoice-dollar" label="Total Monthly Dues" :hasCurrency="true" :total="$totalMonthlyDues" />
    </div>

    <x-dashboard.page-label title="Announcements Board" />



    <div class="h-auto flex flex-col gap-2">

        @if ($announcement)


                <div class="flex flex-col gap-2 bg-white rounded-lg shadow-md p-2 justify-between w-full h-auto">
                    <div class="flex justify-between items-center">
                        <h1 class="text-xl font-bold text-primary capitalize">
                            {{ $announcement->title }}
                        </h1>
                        <p class="text-xs text-gray-500">
                            {{ date('F d, Y h:s A', strtotime($announcement->created_at)) }}
                        </p>
                    </div>



                    <div class="truncate text-sm">
                        {!! $announcement->description !!}
                    </div>

                    @if ($announcement->image)

                            <img src="{{ $announcement->image }}" alt="" srcset=""
                                class="object-center aspect-auto w-full object-cover">

                    @endif

                    <div>
                        <a class="btn btn-primary" href="{{ route('tenant.announcements.show', ['announcement' => $announcement->id]) }}">
                            Read More
                        </a>
                    </div>


                    {{-- <div class="flex items-center justify-center border-t border-gray-200 p-2">
                        <h1 class="flex items-center gap-2 text-sm">
                            <i class="fi fi-rr-comment-alt"></i>
                            <span>{{ $announcement->announcementFeeds()->count() }}</span>
                        </h1>
                    </div> --}}
                </div>

        @else
            <h1>No Latest Announcement</h1>
        @endif

    </div>

</x-dashboard.tenant.base>
