<x-dashboard.tenant.base>


    <x-notification-message />

    <x-dashboard.page-label title="Bill Summary" />

    <div class="panel p-2  flex  flex-col  gap-2">
        <div class="flex flex-col justify-center items-center  border-b border-gray-100">
            <div class="flex items-center">
                <img src="{{ asset('logo.png') }}" alt="" srcset="" class="h-16 w-16 object-center">
                <h1 class="text-3xl font-bold tracking-widest text-primary capitalize">Ciudad De Strike</h1>
            </div>
            <p class="text-xs">Phase 1</p>
        </div>
        <div class="flex justify-between items-center">
            <h1 class="font-bold capitalize">Month : {{ $bill->created_at->format('F') }}</h1>
            <p class="text-xs text-gray-500">
                Gererated At: {{ date('F d, Y h:s A', strtotime($bill->created_at)) }}
            </p>
        </div>

        <h1 class="text-primary font-bold mt-2">
            Type: {{ $bill->type }}
        </h1>
        <h1 class="text-primary font-bold mt-2">
            Due Date: <span> {{ date('F d, Y', strtotime($bill->due_date)) }}</span>
        </h1>


        <div class="flex flex-col h-full justify-between">
            <div class="grid grid-cols-2 grid-flow-row gap-2">
                <h1 class="font-bold">Amount : </h1>
                <div class="w-full flex  justify-end">
                    <p> ₱ {{ number_format($bill->amount, 2) }}</p>
                </div>

            </div>
            {{-- <div class="grid grid-cols-2 grid-flow-row gap-2 border-t border-gray-100 py-2">
                <h1 class="font-bold">Due Date : </h1>
                <div class="w-full flex  justify-end">

                </div>
            </div> --}}

            <div class="grid grid-cols-2 grid-flow-row gap-2 border-t border-gray-100 py-2">
                <h1 class="font-bold">Total : </h1>
                <div class="w-full flex  justify-end">
                    <p> ₱ {{ number_format($bill->amount, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="panel p-2  flex  flex-col  gap-2">

        <div x-data="{ open: false }">
            <div class="flex items-center justify-between bg-gray-100 rounded-t-lg">
                <h1 class="text-xl font-bold text-center p-5">Payment Account</h1>
                <button class="mr-5" @click="open = !open">
                    <template x-if="!open">
                        <i class="fi fi-rr-angle-small-down"></i>
                    </template>
                    <template x-if="open">
                        <i class="fi fi-rr-angle-small-up"></i>
                    </template>
                </button>
            </div>
            <div class="flex flex-col space-y-10" x-show="open" x-transition.duration.700>
                <div class="flex items-center justify-between border-b border-gray-200 py-2">
                    <h1>Account Name:</h1>
                    <p class="font-bold">
                        {{ $paymentAccount->name }}
                    </p>
                </div>
                <div class="flex items-center justify-between border-b border-gray-200 py-2">
                    <h1>Account Number:</h1>
                    <p class="font-bold">
                        {{ $paymentAccount->account_number }}
                    </p>
                </div>
                <h1 class="font-bold text-lg">QR Code:</h1>
                <div class="flex justify-center">
                    <img src="{{ $paymentAccount->qr_code }}" alt="" srcset="" class="w-1/2 aspect-auto">
                </div>
            </div>
        </div>





        <form method="POST" action="{{ route('tenant.bill-payment.store') }}" class="flex flex-col gap-2"
            enctype="multipart/form-data" x-data="{ open: false }">

            @csrf
            <p class="text-xs"> Note: Please ensure that all fields are filled out correctly. Providing incorrect
                information may lead to penalties as per our organization's regulations. <button
                    class="link link-info capitalize" @click.prevent="open = !open">
                    <template x-if="!open" class="!open">
                        <span>View</span>
                    </template>
                    <template x-if="open" class="!open">
                        <span class="text-error">close</span>
                    </template>

                    Regulations</button></p>


            <div class="whitespace-pre-line" x-show="open" x-transition.duration.700>
                <h1 class="font-bold">Regulation on the Submission of False Information or Incorrect Data</h1>

                1. Purpose

                To uphold the integrity and trustworthiness of our operations, this regulation establishes the
                consequences for individuals who submit false information or incorrect data within the organization.

                2. Applicability

                This regulation applies to all Tenants, employees, contractors, and affiliates of the organization.

                3. Offenses and Consequences

                First Offense: Formal Warning

                Upon the first instance of submitting false information or incorrect data, the individual will receive a
                formal written warning. This warning will detail the nature of the offense and serve as an official
                notice to refrain from future violations.
                Second Offense: Penalty

                If a second violation occurs, the individual will face a penalty. This penalty may include, but is not
                limited to:
                Suspension of certain privileges or responsibilities.
                Mandatory training or educational sessions.
                Financial fines, if applicable.
                The specific penalty will be determined based on the severity and context of the violation.
                Third Offense: Expulsion

                A third violation will result in the immediate expulsion of the individual from the organization. This
                action is taken to preserve the organization's integrity and maintain trust among its members and
                stakeholders.



                4. Right to Appeal

                Individuals have the right to appeal any disciplinary action within 14 days of receiving notice. Appeals
                must be submitted in writing to the designated review committee, which will assess the appeal and render
                a decision within 30 days.

                5. Effective Date

                This regulation is effective immediately and will be enforced henceforth.

                6. Review and Amendments

                This regulation will be reviewed annually and may be amended as deemed necessary by the organization's
                leadership.



            </div>
            <div class="flex flex-col gap-2">
                <h1 class="text-xs">
                    Refference Number <span class="text-xs text-error">*</span>
                </h1>
                <input type="number" name="refferrence_number" class="input-generic">
            </div>
            <div class="flex flex-col gap-2">
                <h1 class="text-xs">
                    Amount <span class="text-xs text-error">*</span>
                </h1>
                <input type="number" name="amount" class="input-generic">
            </div>
            <div class="flex flex-col gap-2">
                <h1 class="text-xs">
                    Proof of Payment <span class="text-xs text-error">*</span>
                </h1>
                <input type="file" name="receipt" class="file-input file-input-primary file-input-sm">
            </div>

            <input type="hidden" name="bill_id" value="{{$bill->id}}">
            <input type="hidden" name="payment_account_id" value="{{$paymentAccount->id}}">


            <button class="btn btn-primary text-accent">
                Pay
            </button>
        </form>



    </div>
</x-dashboard.tenant.base>
