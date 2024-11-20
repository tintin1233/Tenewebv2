<x-dashboard.tenant.base>


    @php
        $user = Auth::user();
    @endphp

    <div class="panel p-2 border-none shadow-none bg-gray-50">
        <x-dashboard.page-label :title="__('Requirements')" />

        <div class="bg-white rounded-lg min-h-screen flex flex-col items-center p-5 shadow-lg mt-2 font-serif">

            <h1 class="flex items-center text-xl font-bold gap-5"> <span>
                    <img src="{{ asset('logo.png') }}" alt="" class="w-12 aspect-square rounded-full"></span>
                <span>
                    CUIDAD DE STRIKE HOMEOWNERS ASSOCIATION, INC
                    <p class="font-thin text-xs text-center">Molino Road, Molino 1, Bacoor City</p>
                </span>

            </h1>

            <div class="text-justify ml-16 mr-12 mt-20 flex flex-col gap-5 w-full">
                <div class="w-full  mx-auto my-8 ">
                    <h2 class="text-lg font-bold mb-4">Checklist (Single)</h2>
                    <div class="border border-black">
                        <div class="flex">
                            <div class="w-1/5 border-r border-black p-2 font-bold">Name:</div>
                            <div class="w-4/5 p-2"></div>
                        </div>
                        <div class="border-t border-black p-2">APPLICATION FORM</div>
                        <div class="border-t border-black p-2">GOVERNMENT ID</div>
                        <div class="border-t border-black p-2">BARANGAY CERTIFICATE (DANGER ZONE OR ISF)</div>
                        <div class="border-t border-black p-2">COE/AFFIDAVIT OF INCOME</div>
                        <div class="border-t border-black p-2">PSA BIRTH CERTIFICATE (ORIGINAL)</div>
                        <div class="border-t border-black p-2">PSA CENOMAR (ORIGINAL)</div>
                    </div>
                </div>


                <div class="w-full  mx-auto my-8 ">
                    <h2 class="text-lg font-bold mb-4">Checklist ( Married )</h2>
                    <div class="border border-black">
                        <div class="flex">
                            <div class="w-1/5 border-r border-black p-2 font-bold">Name:</div>
                            <div class="w-4/5 p-2"></div>
                        </div>
                        <div class="border-t border-black p-2">APPLICATION FORM</div>
                        <div class="border-t border-black p-2">GOVERNMENT ID</div>
                        <div class="border-t border-black p-2">BARANGAY CERTIFICATE (DANGER ZONE OR ISF)</div>
                        <div class="border-t border-black p-2">COE/AFFIDAVIT OF INCOME</div>
                        <div class="border-t border-black p-2">PSA BIRTH CERTIFICATE (ORIGINAL)</div>
                        <div class="border-t border-black p-2">PSA MARRIAGE CERTIFICATE ( ORIGINAL )
                        </div>
                        <div class="border-t border-black p-2">ID OF SPOUSE
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-dashboard.tenant.base>
