@extends('jobseeker.layouts.main')

@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-user.css') }}">
@endsection

@section('content')
<section class="app-user-edit">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="font-size:24px;">Help ?</h1>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="accordion" id="accordionExample">
                            <!-- Card 1 - Start -->
                            <div class="card mb-1" style="border:1px solid #041151;">
                            <div class="card-header" id="headingOne" style="background-color:#041151;">
                                <h1 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color:white;">
                                    Create Campaign (Paano lumikha ng Kampanya ?)
                                </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 1 </span> Mag-login sa ePondo. Pumunta sa 'My Account'.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 2 </span> Pumunta sa 'My Campaigns'. Pindutin ang 'Create' button.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 3 </span> Punan lahat ng hinihingi na impormasyon na kailangan para sa iyong kampanya. Maari din maglagay ng mga karagdagang larawan upang mas maintindihan ang iyong kampanya.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 4 </span> Pindutin ang 'Submit' button pag tapos na.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 5 </span> Congratulations! Nakalikha ka na ng iyong kampanya sa ePondo.</div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!-- Card 1 - End -->
                            <!-- Card 2 - Start -->
                            <div class="card mb-1" style="border:1px solid #041151;">
                            <div class="card-header" id="headingTwo" style="background-color:#041151;">
                                <h1 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" style="color:white;">
                                    Create Service (Paano lumikha ng Serbisyo ?)
                                </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 1 </span> Mag-login sa ePondo. Pumunta sa 'My Account'.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 2 </span> Pumunta sa 'My Services'. Pindutin ang 'Create' button.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 3 </span> Punan lahat ng hinihingi na impormasyon na kailangan para sa iyong serbisyo. Maari din maglagay ng mga karagdagang larawan upang mas maintindihan ang iyong serbisyo</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 4 </span> Pindutin ang 'Submit' button pag tapos na.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 5 </span> Congratulations! Nakalikha ka na ng iyong serbisyo sa ePondo.</div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!-- Card 2 - End -->
                            <!-- Card 3 - Start -->
                            <div class="card mb-1" style="border:1px solid #041151;">
                            <div class="card-header" id="headingThree" style="background-color:#041151;">
                                <h1 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree" style="color:white;">
                                    Service Order (Proseso ng Service Order ?)
                                </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse " aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 1 </span> Backer ay magaavail ng serbisyon mo. Tuwing merong gusto magavail/humingi ng iyong serbisyo, makakatanggap ka ng email at abiso sa iyong account tungkol rito. (Status: Pending Request)</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 2 </span> Pumunta sa 'Service Orders'. Pindutin ang eye icon (mata) upang makita ang kabuuan ng service order.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 3 </span> Basahin ang mga detalye ng order request. Kapag ikaw ay sangayon sa lahat ng hinihiling ng customer at nais mong tanggapin ang order request, pindutin lamang ang "Accept". Kapag ikaw sumasalungat rito, pindutin ang "Decline".</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 4 </span> Kapag ang iyong napili ay 'Accepted' (Status: Accepted) </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                        <div class="just ml-2"><span style="color:#041151;font-weight:bold; font-size:14px;">4.1 Payment Method/ Pamamaraan ng pagbayad : Online Payment (OP) </span><br><br>
                                        Kapag iyong nakumpleto na ang service order para sa iyong customer, pindutin lamang ang "Submit Service Order Delivered". Ito ay nangangahulugan na natapos mo na ang service order at naihatid na sa iyong customer ng kumpleto.<br><br>
                                        Inabisuhan na namin ang iyong Backer/Customer tungkol sa nakabinbin na bayarin para sa iyong nakumpleto at naihatid na serbisyo. Maari lamang maghintay ukol rito. (Status: Pending Payment) <br><br>
                                        Kapag matagumpay na nabayaran ni backer/customer. Ikaw ay aming agad aabisuhin tungkol rito. Ang susunod na hakbang ay pagbigay ng puna at marka sa karanasan ng paggamit ng ePondo at pagbigay serbisyo. (Status: Pending Feedback & Rating) <br><br>
                                        </div>
                                        <div class="just ml-2"><span style="color:#041151;font-weight:bold; font-size:14px;">4.2 Payment Method/ Pamamaraan ng pagbayad : Cash-On-Delivery (COD) </span><br><br>
                                        Kapag iyong nakumpleto na ang service order para sa iyong customer at natanggap na ang kabuuang bayad, pindutin lamang ang "Submit Service Delivered & Payment Received". Ito ay nagkakahulugan na nakumpleto at naihatid mo na ang service order sa iyong customer at natanggap mo na rin ang kabuuang bayad para rito.<br><br>
                                        Ang susunod na hakbang ay pagbigay ng puna at marka sa karanasan ng paggamit ng ePondo at pagbigay serbisyo. (Status: Pending Feedback & Rating) <br><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 5 </span> Nakabinbing pagbibigay puna at marka sa karanasan ng paggamit ng ePondo at pagbigay serbisyo. Pindutin lamang ang "Submit Feedback & Rating" button at punan lahat ng hinihinging impormasyon. </div>
                                </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 6 </span> Congratulations! Kumpleto at natapos na ang iyong Service Order.</div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!-- Card 3 - End -->
                            <!-- Card 4 - Start -->
                            <div class="card mb-1" style="border:1px solid #041151;">
                            <div class="card-header" id="headingFour" style="background-color:#041151;">
                                <h1 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour" style="color:white;">
                                    Campaign Donations (Paano makukuha ang mga nalikom na mga donasyon ?)
                                </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 1 </span> Mula sa iyong Account, pumunta lamang sa 'Earnings' tab.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 2 </span> Pindutin ang 'Campaign Funds' tab.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 3 </span> Hanaping ang iyong kampanya mula sa talahanyan (table) sa ibaba. Makikita rito ang 'Withdraw Available Funds' button, pindutin lamang ito.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 4 </span> Punan lahat ng hinihingi na impormasyon. (Amount,Bank Details,Contact No.) Pagkatapos ay pindutin lamang ang 'Submit Request'. </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 5 </span> Maghintay lamang ng 1-3 araw sa pag proseso ng donasyon. Aabisuhin namin kayo agad kapag ito ay matagumpay na-itransfer sa iyong banko.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 6 </span> Congratulations! Natanggap mo na ang iyong nalikom na mga donasyon.</div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!-- Card 4 - End -->
                            <!-- Card 5 - Start -->
                            <div class="card mb-1" style="border:1px solid #041151;">
                            <div class="card-header" id="headingFive" style="background-color:#041151;">
                                <h1 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive" style="color:white;">
                                    Service Order Earnings (Paano makukuha ang bayad/kita mula sa service order ?) 
                                </button>
                                </h5>
                            </div>
                            <div id="collapseFive" class="collapse " aria-labelledby="headingFive" data-parent="#accordionExample">
                                <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 1 </span> Mula sa iyong Account, pumunta lamang sa 'Earnings' tab.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 2 </span> Pindutin ang 'Service Earnings' tab.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 3 </span> Pindutin ang 'Withdraw Available Earnings' button. Paalala na ito ay lalabas/makikita lamang tuwing merong 'Available Earnings' (Hindi pa nakukuhang kita). Pinagsama na sa 'Available Earnings' ang nakuhang 'Service Order Earnings' (Bayad mula sa serbisyo) at ang 'Rewards Earned' (Nakuhang karagdagang premyo) sa pagkompleto ng serbisyo.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 4 </span> Punan lahat ng hinihingi na impormasyon. (Bank Details) Pagkatapos ay pindutin lamang ang 'Submit Request'.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 5 </span> Maghintay lamang ng 1-3 araw sa pag proseso ng service earnings. Aabisuhin namin kayo agad kapag ito ay matagumpay na-itransfer sa iyong banko.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 6 </span> Congratulations! Natanggap mo na ang iyong service order earnings.</div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!-- Card 5 - End -->
                            <!-- Card 6 - Start -->
                            <div class="card mb-1" style="border:1px solid #041151;">
                            <div class="card-header" id="headingSix" style="background-color:#041151;">
                                <h1 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix" style="color:white;">
                                    Rewards (Paano matatanggap ang rewards ?)
                                </button>
                                </h5>
                            </div>
                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                                <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just">Ang rewards ay nakabase sa points system na gingamit ng ePondo. Sa ibat ibang tasks/gawain sa ePondo ay meron itong katumbas na points. Kapag mas madami ang points na malilikom, mas malaki rin ang makukuhang rewards.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just">Ang rewards ay nakukuha sa bawat service order na naikompleto. Ito ay pinapatong sa bayarin ng iyong backer/customer at makikita ito bilang 'transaction fee'. </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just">Silver Tier 100-499 points, 0.6% rewards.<br>
                                                        Gold Tier 500-999 points, 1.2% rewards.<br>
                                                        Platinum Tier 1000+ points, 2.0% rewards.</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col" style="text-align: left;">
                                    <div class="just">Sample Computation:<br><br>
                                    100.00  Service Price<br>
                                    2.00    Transaction Fee ('Platinum Tier' Rewards)<br>
                                    <span style="border:1px solid black;padding:2px;">102.00  Total Earned</span> </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just">Maari ring makuha ang rewards kasingtulad ng proseso sa pagkuha ng service order earnings.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 1 </span> Mula sa iyong Account, pumunta lamang sa 'Earnings' tab.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 2 </span> Pindutin ang 'Service Earnings' tab. Pinagsama na sa 'Available Earnings ang nakuhang Service Order Earnings (Bayad mula sa serbisyo) at ang Rewards Earned (Nakuhang karagdagang premyo) sa pagkompleto ng serbisyo'</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 3 </span>  Pindutin ang 'Withdraw Available Earnings' button. Paalala na ito ay lalabas/makikita lamang tuwing merong 'available earnings' (Hindi pa nakukuhang kita at reward).</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 4 </span>  Punan lahat ng hinihingi na impormasyon (Bank Details). Pagkatapos ay pindutin lamang ang 'Submit Request'.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 5 </span>  Maghintay lamang ng 1-3 araw sa pag proseso ng service earnings at rewards. Aabisuhin namin kayo agad kapag ito ay matagumpay na-itransfer sa iyong banko.</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col" style="text-align: left;">
                                    <div class="just"><span style="color:#041151;font-weight:bold; font-size:18px;">Step 6 </span>  Congratulations! Natanggap mo na ang iyong service order earnings at rewards.</div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!-- Card 6 - End -->
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>    
@endsection