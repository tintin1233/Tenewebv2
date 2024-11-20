<x-dashboard.tenant.base>


    @php
        $user = Auth::user();
    @endphp

    <div class="panel p-2 border-none shadow-none bg-gray-50">
        <x-dashboard.page-label :title="__('Penalties')" />

        <div class="bg-white rounded-lg min-h-screen flex flex-col items-center p-5 shadow-lg mt-2 font-serif">

            <h1 class="flex items-center text-xl font-bold gap-5"> <span>
                    <img src="{{ asset('logo.png') }}" alt="" class="w-12 aspect-square rounded-full"></span>
                <span>
                    CUIDAD DE STRIKE HOMEOWNERS ASSOCIATION, INC
                    <p class="font-thin text-xs text-center">Molino Road, Molino 1, Bacoor City</p>
                </span>

            </h1>

            <div class="text-justify ml-16 mr-12 mt-20 flex flex-col gap-5">
                <p class="font-semibold">
                    MGA SANCTIONS / PENALTIES O KAPARUSAHAN
                </p>

                <ul class="list-decimal flex flex-col gap-5">

                    <li>
                        <p> PAGSASAMPAY NG DAMIT NG WALA SA LUGAR
                            <p />
                        <ul class="flex flex-col gap-2 mt-2">
                            <li>
                                a. 1ST Offense – Warning
                            </li>
                            <li>
                                b. 2nd Offense - ₱100.00
                            </li>
                            <li>
                                c. 3
                                rd Offense - ₱300.00
                            </li>
                            <li>
                                d. 4th Offense – Expulsion
                            </li>

                        </ul>

                    </li>

                    <li>
                        <p> MGA ALAGANG HAYOP NA PAGALA-GALA</p>
                        <ul class="flex flex-col gap-2 mt-2">
                            <li>
                                1st Offense – Paghuli sa hayop at warning
                            </li>
                            <li>
                                2nd Offense – Paghuli sa hayop at pag turn-over sa dog found
                            </li>
                            <li>
                                3rd Offense – Expulsion
                            </li>


                        </ul>
                    </li>

                    <li>
                        <p> PAG-GAMIT NG VIDEOKE</p>
                        <ul class="flex flex-col gap-2 mt-2">
                            <li>
                                a. 1st Offense – Warning
                            </li>
                            <li>
                                b. 2nd Offense - ₱ 500.00
                            </li>
                            <li>
                                c. 3rd Offense - ₱ 1000.00
                            </li>
                            <li>
                                d. 4th Offense – Expulsion
                            </li>

                        </ul>
                    </li>
                    <li>
                        <p> MGA AWAY NG KABATAAN AT MGA MAG-ASAWAMGA BATA: MGA MAG ASAWA:</p>

                        <div class="grid grid-cols-2 grid-flow-row gap-2">
                            <ul class="flex flex-col gap-2 mt-2">
                                <li class="list-none">
                                    <p>MGA MAG ASAWA:</p>
                                </li>
                                <li>
                                    a. 1st Offense – Warnin
                                </li>
                                <li>
                                    b. 2nd Offense - ₱ 300.00
                                </li>
                                <li>
                                    c. 3rd Offense - Expulsion
                                </li>

                            </ul>
                            <ul class="flex flex-col gap-2 mt-2">
                                <li class="list-none">
                                    <p>MGA BATA</p>
                                </li>
                                <li>
                                    a. 1st Offense – Warning
                                </li>
                                <li>
                                    b. 2nd Offense – Multa ng magulang ₱500.00
                                </li>
                                <li>
                                    c. 3rd Offense – ₱500.00 turn-over PNP
                                </li>
                                <li>
                                    d. 4th Offense – Turn-over PNP or expulsion
                                </li>

                            </ul>
                        </div>

                    </li>

                    <li>
                        <p> MGA KABATAANG LUMALABAG SA CURFEY TIME: 10PM</p>
                        <p>
                            15 EDAD PABA

                        </p>
                        <ul class="flex flex-col gap-2 mt-2">
                            <li>
                                a. 1st Offense – Warning
                            </li>
                            <li>
                                b. 2nd Offense – ₱100.00 to be paid by parents
                            </li>
                            <li>
                                c. 2nd Offense – ₱300.00 to be paid by parents
                            </li>
                            <li>
                                d. 4th Offense – Expulsion of member parents
                            </li>

                        </ul>


                        <p>
                            16 EDAD PATAAS

                        </p>
                        <ul class="flex flex-col gap-2 mt-2">
                            <li>
                                a. 1st Offense – Warning
                            </li>
                            <li>
                                b. 2nd Offense – ₱200.00 to be paid by parents
                            </li>
                            <li>
                                c. 2nd Offense – ₱300.00 to be paid by parents
                            </li>
                            <li>
                                d. 4th Offense – Expulsion of member violator or the parent member.
                            </li>

                        </ul>
                    </li>

                    <li>
                        <p> PAG-INOM NG ALAK PAGSUSUGAL SA LABAS NG UNIT/TIRAHAN</p>
                        <ul class="flex flex-col gap-2 mt-2">
                            <li>
                                a. 1st Offense – Warning
                            </li>
                            <li>
                                b. 2nd Offense - ₱ 200.00
                            </li>
                            <li>
                                c. 3rd Offense - ₱ 400.00
                            </li>
                            <li>
                                d. 4th Offense – Expulsion
                            </li>

                        </ul>
                    </li>
                    <li>
                        <p>ANG PAGKUHA / PAG-GAMIT NG PERSONAL NA GAMIT NG KAPWAMIYEMBRO NG WALANG PAALAM O ANG TAHASANG PAGNANAKAW</p>
                        {{-- <ul class="flex flex-col gap-2 mt-2">
                            <li>
                                a. 1st Offense – Warning
                            </li>
                            <li>
                                b. 2nd Offense - ₱ 200.00
                            </li>
                            <li>
                                c. 3rd Offense - ₱ 400.00
                            </li>
                            <li>
                                d. 4th Offense – Expulsion
                            </li>

                        </ul> --}}
                    </li>

                </ul>
            </div>

        </div>

    </div>
</x-dashboard.tenant.base>
