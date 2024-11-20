<x-dashboard.tenant.base>


    @php
        $user = Auth::user();
    @endphp

    <div class="panel p-2 border-none shadow-none bg-gray-50">
        <x-dashboard.page-label :title="__('Agreement')" />

        <div class="bg-white rounded-lg min-h-screen flex flex-col items-center p-5 shadow-lg mt-2 font-serif">

            <h1 class="flex items-center text-xl font-bold gap-5"> <span>
                    <img src="{{ asset('logo.png') }}" alt="" class="w-12 aspect-square rounded-full"></span>
                <span>
                    CUIDAD DE STRIKE HOMEOWNERS ASSOCIATION, INC
                    <p class="font-thin text-xs text-center">Molino Road, Molino 1, Bacoor City</p>
                </span>

            </h1>

            <div class="text-justify ml-16 mr-12 mt-20 flex flex-col gap-5">
                <p>
                    Ako si <span
                        class="font-bold capitalize">{{ $user->profile->last_name }},{{ $user->profile->first_name }}
                        {{ $user->profile->middle_name === 'N\A' ? ' ' : $user->profile->middle_name }} </span> na isang
                    miyembro ng <span class="font-bold">CIUDAD DE STRIKEHOA, INC., PHASE 1 </span> nasa hustong edad, may
                    asawa/binata/dalaga/widow, hiwalay/live-in at
                    kasalukuyang naninirahan sa CIUDAD DE STRIKE HOA, INC., PHASE 1 Molino Road, Molino 1,
                    Bacoor City.
                </p>

                <span class="text-center w-full">AT</span>



                <p>
                    CIUDAD DE STRIKE HOA, INC., PHASE 1 na kinatawan ni Edwin V. GereroPresidente ng Cluster ____ na
                    matatagpuan sa address na Molino Road, Molino 1, Bacoor City.
                </p>


                <p class="font-bold">PAGPAPATUNAY:</p>


                <ul class="list-disc flex flex-col gap-5">
                    <li class="indent-8">
                        Na upang mapanatili ang katahimikan at kalinisan ng CIUDAD DE STRIKE HOA, INC.
                        PHASE 1 ay nagpasa ng Resolution bilang 001-2019 na nagsasaad ng mga alituntunin at batas na
                        dapat
                        tupadin ng bawat miyembro sa simula pa lamang ng pagtira nila sa nasabing asosasyon at narito
                        and
                        mgasumusunod:

                        <ul class="list-decimal ml-10 mt-2 flex flex-col gap-5 text-justify">
                            <li>
                                Ang pagbabawal sa pagsasampay ng mga nilabhang mga damit sa labas ng
                                kanilanginookupahang unit.
                            </li>
                            <li>Ang pagbabawal sa mga alagang hayop na walang wastong kulungan o nakakawala o
                                pagalagala, gaya ng aso, pusa, kambing, manok, baka, o kalabaw. </li>
                            <li> Ang pagbabawal sa away mag-asawa, anak o mga kamag-anak na nagdudulot ng ingay oistorbo
                                sa mga kapitbahay. </li>
                            <li> Ang pagbawal sa pag-gamit ng videoke ng walang okasyon at sumobra sa itinakdang oras
                                ngpag-gamit nito. </li>
                            <li> Ang pagbabawal sa mga kabataan edad 20 pababa na pagala-gala sa dis oras ng gabi dapat
                                nasaloob ng bahay 7pm at 21 pataas ay 10pm o curfew HR.. </li>
                            <li>Ang pagbabawal sa pag-iinom ng alak o nakalalasing na inumin at paglalaro ng ano mang
                                uri
                                ng sugal sa loob mismo ng area ng asosasyon. </li>
                            <li>Ang pagbabawal sa pagkakalat o pagtapon ng kahit na anong uri ng basura sa labas ng
                                bawat
                                unit o sa pangkalahatang sakop ng Ciudad de Strike HOA, Inc. 2. </li>
                            <li>Ang pagbabawal sa sino mang miyembro at opisyal na pasimuno sa pag-gawa ng mga bagay
                                napagsisimulan ng kaguluhan o away ng mga bata, kabataan at pati na mga matatanda. </li>
                            <li> Ang pagbabawal sa pagkuha ng ano mang personal na gamit ng kapwa miyembro ng
                                walangpaalam o pahintulot o sa bandang huli ay maituturing na pagnanakaw. </li>
                            <li>Ang pagbabawal sa karagdagang “ improvement ” na gustong ilagay sa labas at courtyard
                                ngbawat unit o tirahan maliban sa loob ng nasabing unit o tirahan. </li>
                            <li>Ang pagbabawal na “ i-convert ” ang tirahan sa ano mang uri gaya ng painuman o bar,
                                sugalan, boarding house at tindahan. </li>
                            <li>Ang pagtalima o pagsunod sa itinakdang “ Drug Test ” na nag-eedad sa 13pataas para
                                sabawat miyembro ng pamilya at kung positive ang miyembro at kanyang pamilya ay dapat
                                paalisin o kusang aalis at kung ayaw magpa drug test ito rin ay matatanggal at hindi
                                namaaring magreklamo sa barangay o hukuman, at yearly anf drug test. </li>
                            <li> Ang obligasyong dumalo sa pagpupulong o miting na ipapatawag ng asosasyon. </li>
                            <li> Ang regular na pagbayad ng BUTAW ( montly dues ) ay mahigpit na ipinapatupad
                                paramagsilbing pondo ng asosasyon. </li>


                            <li> Mahigpit na ipinagbabawal ang pagmamaneho ng motorsiklo o ano mang uri ng
                                sasakyanmaliban
                                sa bisikleta para sa mga kabataang walang lisensiya sa pagmamaneho at lalong-lalo nasa
                                mga menor de edad sa loob ng subdivision.</li>
                            <li>Bawal na gawing istambayan ang mga hagdanan o ang paglalagay ng ano mang bagay
                                namagsisilbing “ obstruction ” sa paggamit nito. </li>
                            <li> Ang pagpapark ng lahat ng uri ng sasakyan ay kinakailangan sa itinakdang lugar o
                                designatedparking lot kung kaya ipinagbabawal ang pag park ng mga ito sa harap ng unit o
                                bldg. O ibapang lugar na magiging obstruction lamang.</li>
                        </ul>
                    </li>
                    <li>KARAGDAGANG PAGLILINAW

                        <ul class="list-decimal ml-10 mt-2 flex flex-col gap-5 text-justify">
                            <li>
                                <h1 class="font-bold">PAGSASAMPAY SA MGA NILABHANG DAMIT</h1>
                                Pinapahintulutan ang pagsasampay ng nilabhang damit sa labas ng unit na inookupahan
                                kungmay ipinagawang sabitan ng mga nakahanger na mga damit na ang
                                taas ay di lalampas sarailing ng building at kinakailangang may tamang space na ilalaan
                                para madaanan.
                            </li>
                            <li>
                                <h1 class="font-bold"> MGA ALAGANG HAYOP</h1>
                                Pinapahintulutan ang pag aalaga ng hayop gaya ng aso at pusa subalit kinakailangang
                                maywasto itong kulungan na ilalagay sa loob ng unit o tirahan at di maaring ilagay sa
                                labas ngpinto o unit kahit pa itoy temporary o panandalian lamang.

                            </li>
                            <li>
                                <h1 class="font-bold"> ANG PAG-GAMIT NG VIDEOKE</h1>
                                Bago gamitin ang videoke o sing-along kailangang humingi muna ng permiso sa pamunuan
                                oopisyales ng asosasyon.

                            </li>

                            <li>
                                <h1 class="font-bold"> ANG TAKDANG ORAS PARA SA MGA KABATAANa. </h1>
                                a. Ang nag eedad 20 pababa ay kailangang nasa loob na ng tirahan at di na pagala-gala
                                saganap na ika pito ng gabi.
                                b. Ang nag eedad 21 pataas ay kailangang nasa loob na ng unit o tirahan sa ganap na 10pm
                                ocurfew time.
                            </li>


                            <li>
                                <h1 class="font-bold"> ANG PAGLALABAS O PAGTATAPON NG BASURA</h1>
                                Kung may kinontratang kumolekta ng basura ito ay kinakailangang ilalabas lamang ng
                                tirahansa itatakdang oras kung kailan ito kukunin.

                            </li>

                            <li>
                                <h1 class="font-bold"> ANG PAGBABAWAL SA PLANONG IMPROVEMENT</h1>
                                Mahigpit na ipinagbabawal ang pagpapagawa ng ano mang karagdagang improvement gaya ngmga
                                sumusunod:
                                1. Pagpipintura ng kaiba sa pangkalahatang kulay ng sa labas ng building.
                                2. Hindi pwedeng gibain o butasan ang wall.
                                3. Ang pagpapagawa ng ano mang bagay na magiging sagabal o obstruction sa daaanan.
                                4. Di rin pwede itong tambakan ng excess o sobrang gamit at di rin ito pwedeng lagyan
                                ngano mang uri ng halaman.
                            </li>


                            <li>
                                <h1 class="font-bold"> CONVERTION NG TIRAHAN</h1>
                                a. Ang bawat unit o tirahan ay ipinagkaloob sa inyo ng gobyerno para kayo ay magkaroon
                                ngdisenteng tirahan kung kaya mahigpit na ipinagbabawal na ito ay gagamitin maliban sa
                                tirahanlamang pati ng buong pamilya.
                                b. Ang pagdalo sa mga pagpupulong o meeting ng pinatutupad ng asosasyon ay
                                isangimportanteng
                                obligasyon ng bawat miyembro.
                            </li>

                            <li>
                                <h1 class="font-bold"> ANG PAGPARK NG LAHAT NG URI NG SASAKYAN</h1>
                                Pansamantalang pinahihintulutan ang pagpark ng mga
                                sasakyan sa mga kalsada o sa harap ngunit sa ground floor habang hindi pa nagagawa o
                                maayos
                                ang designated na lugar na gagawingparking lot. Subalit pag ito ay nagawa ay kaagad na
                                ipatutupad ang batas at ang pagpataw ngkaparusahan.
                            </li>


                        </ul>
                    </li>
                </ul>

            </div>



        </div>

    </div>
</x-dashboard.tenant.base>
