<x-dashboard.tenant.base>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .checker{
        font-size:2vh;
    }
.text-primary {
    --tw-text-opacity: 1;
    color: var(--fallback-p, oklch(var(--p) / var(--tw-text-opacity))) !important;
}
/* Responsive Design */
@media (max-width: 768px) {

    .checker{
        font-size:1.5vh;
        margin-left:-1vh;
    }
}
</style>
    <div class="panel p-2 border-none shadow-none bg-none">
        <x-dashboard.page-label :title="__('Documents')" />



        <div class="row">
            <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{route('tenant.documents.agreement')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-document-signed text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary checker">
                   Agreement
                </h1>
            </a>
        </div>
            {{--

            <div class="col-md-6 col-xs-12 col-sm-12">
             <a class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary checker">
                    Tenants
                </h1>
            </a> 
        </div>--}}
            <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{route('tenant.documents.penalty')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-document-signed text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary checker">
                  Penalties
                </h1>
            </a>
        </div>
            <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{route('tenant.documents.requirement')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-document-signed text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary checker">
                    Requirements
                </h1>
            </a>
        </div>
        </div>
    </div>
</x-dashboard.tenant.base>
