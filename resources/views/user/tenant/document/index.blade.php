<x-dashboard.tenant.base>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <div class="panel p-2 border-none shadow-none bg-none">
        <x-dashboard.page-label :title="__('Documents')" />



        <div class="row">
            <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{route('tenant.documents.agreement')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-document-signed text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary" style="font-size:2vh;">
                   Agreement
                </h1>
            </a>
        </div>
            {{--

            <div class="col-md-6 col-xs-12 col-sm-12">
             <a class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary" style="font-size:2vh;">
                    Tenants
                </h1>
            </a> 
        </div>--}}
            <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{route('tenant.documents.penalty')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-document-signed text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary" style="font-size:2vh;">
                  Penalties
                </h1>
            </a>
        </div>
            <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{route('tenant.documents.requirement')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-document-signed text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary" style="font-size:2vh;">
                    Requirements
                </h1>
            </a>
        </div>
        </div>
    </div>
</x-dashboard.tenant.base>
