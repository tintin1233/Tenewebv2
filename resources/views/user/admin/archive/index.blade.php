<x-dashboard.admin.base>

    <div class="panel p-2 border-none shadow-none bg-none">
    <x-dashboard.page-label :title="__('Archived')" />




        <div class="row">

            <div class="col-md-6 col-xs-12 col-sm-12">

            <a href="{{route('admin.archives.announcements.index')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                    Announcements
                </h1>
            </a>
            </div>

            <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{route('admin.rooms.archives')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                   Units
                </h1>
            </a>
            </div>

            <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{route('admin.archives.comments.index')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                    Comments
                </h1>
            </a>
            </div>

            <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{route('admin.archives.payment-accounts.index')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                    Payment Accounts
                </h1>
            </a>
            </div>

            <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{route('admin.archives.tenants.index')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                   Tenants
                </h1>
            </a>
            </div>

            {{-- <a class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                    Tenants
                </h1>
            </a> --}}
            {{-- <a href="{{route('admin.archives.master-list.index')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                    Master List
                </h1>
            </a> --}}
        </div>
    </div>
</x-dashboard.admin.base>
