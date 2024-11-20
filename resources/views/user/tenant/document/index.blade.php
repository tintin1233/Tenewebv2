<x-dashboard.tenant.base>

    <div class="panel p-2 border-none shadow-none bg-none">
        <x-dashboard.page-label :title="__('Documents')" />



        <div class="grid grid-cols-2 grid-flow-row gap-5 h-32 mt-10">
            <a href="{{route('tenant.documents.agreement')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-document-signed text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                   Agreement
                </h1>
            </a>
            {{-- <a class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                    Tenants
                </h1>
            </a> --}}
            <a href="{{route('tenant.documents.penalty')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-document-signed text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                  Penalties
                </h1>
            </a>
            <a href="{{route('tenant.documents.requirement')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-document-signed text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                    Requirements
                </h1>
            </a>
        </div>
    </div>
</x-dashboard.tenant.base>
