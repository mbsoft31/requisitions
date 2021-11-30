<div x-data >
    <div x-show='$wire.show' class="fixed z-50 right-0 inset-y-0 w-full bg-black bg-opacity-25">
        <div class="z-50 flex flex-col w-full h-full max-w-3xl bg-white">
                <header class="bg-gray-50 rounded-t-lg overflow-hidden">

                    <div class="flex items-center justify-between px-6 py-4 space-x-4">
                        <div class="flex-grow">
                            <h1 class="text-xl font-semibold tracking-wide text-gray-700">
                                {{__("Upload Excel File")}}
                            </h1>
                        </div>

                        <button wire:click="closeUploadForm" class="block text-center px-4 py-2 text-lg font-semibold rounded-lg hover:border text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <svg class="text-gray-500 w-4 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg>
                        </button>
                    </div>

                </header>
            <main class="flex-grow divide-y overflow-y-auto">

                <div class="">
{{--                    <form action="#" method="post" class="space-y-8" enctype="multipart/form-data">--}}
                    <form wire:submit.prevent="save" enctype="multipart/form-data">
                        <div class="px-6 py-4">
                            <input wire:model="file" class="hidden" type="file"  id="selectFile">
                        </div>
                        @if($file)
                            <div class="px-6 py-4" >
                                <div class="flex items-start space-x-4 px-6 py-4 border-4 border-dashed border-gray-300">
                                    <div class="w-24 h-24">
                                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Livello_1" x="0px" y="0px" viewBox="0 0 2289.75 2130" enable-background="new 0 0 2289.75 2130" xml:space="preserve">
                                                    <path fill="#185C37" d="M1437.75,1011.75L532.5,852v1180.393c0,53.907,43.7,97.607,97.607,97.607l0,0h1562.036  c53.907,0,97.607-43.7,97.607-97.607l0,0V1597.5L1437.75,1011.75z"/>
                                            <path fill="#21A366" d="M1437.75,0H630.107C576.2,0,532.5,43.7,532.5,97.607c0,0,0,0,0,0V532.5l905.25,532.5L1917,1224.75  L2289.75,1065V532.5L1437.75,0z"/>
                                            <path fill="#107C41" d="M532.5,532.5h905.25V1065H532.5V532.5z"/>
                                            <path opacity="0.1" enable-background="new    " d="M1180.393,426H532.5v1331.25h647.893c53.834-0.175,97.432-43.773,97.607-97.607  V523.607C1277.825,469.773,1234.227,426.175,1180.393,426z"/>
                                            <path opacity="0.2" enable-background="new    " d="M1127.143,479.25H532.5V1810.5h594.643  c53.834-0.175,97.432-43.773,97.607-97.607V576.857C1224.575,523.023,1180.977,479.425,1127.143,479.25z"/>
                                            <path opacity="0.2" enable-background="new    " d="M1127.143,479.25H532.5V1704h594.643c53.834-0.175,97.432-43.773,97.607-97.607  V576.857C1224.575,523.023,1180.977,479.425,1127.143,479.25z"/>
                                            <path opacity="0.2" enable-background="new    " d="M1073.893,479.25H532.5V1704h541.393c53.834-0.175,97.432-43.773,97.607-97.607  V576.857C1171.325,523.023,1127.727,479.425,1073.893,479.25z"/>
                                            <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="203.5132" y1="1729.0183" x2="967.9868" y2="404.9817" gradientTransform="matrix(1 0 0 -1 0 2132)">
                                                <stop offset="0" style="stop-color:#18884F"/>
                                                <stop offset="0.5" style="stop-color:#117E43"/>
                                                <stop offset="1" style="stop-color:#0B6631"/>
                                            </linearGradient>
                                            <path fill="url(#SVGID_1_)" d="M97.607,479.25h976.285c53.907,0,97.607,43.7,97.607,97.607v976.285  c0,53.907-43.7,97.607-97.607,97.607H97.607C43.7,1650.75,0,1607.05,0,1553.143V576.857C0,522.95,43.7,479.25,97.607,479.25z"/>
                                            <path fill="#FFFFFF" d="M302.3,1382.264l205.332-318.169L319.5,747.683h151.336l102.666,202.35  c9.479,19.223,15.975,33.494,19.49,42.919h1.331c6.745-15.336,13.845-30.228,21.3-44.677L725.371,747.79h138.929l-192.925,314.548  L869.2,1382.263H721.378L602.79,1160.158c-5.586-9.45-10.326-19.376-14.164-29.66h-1.757c-3.474,10.075-8.083,19.722-13.739,28.755  l-122.102,223.011H302.3z"/>
                                            <path fill="#33C481" d="M2192.143,0H1437.75v532.5h852V97.607C2289.75,43.7,2246.05,0,2192.143,0L2192.143,0z"/>
                                            <path fill="#107C41" d="M1437.75,1065h852v532.5h-852V1065z"/>
                                                </svg>
                                    </div>

                                    <div class="flex flex-col flex-grow space-y-2">
                                        <div class="uppercase text-xl font-semibold tracking-wider text-gray-500">
                                            {{$file->getClientOriginalName()}}
                                        </div>
                                        <div class="flex items-baseline space-x-4">
                                            <div class="uppercase text-base font-semibold tracking-wider text-gray-500">
                                                تم تسجيل / تعديل :
                                            </div>
                                            <div>
                                                <span class="text-lg font-semibold text-gray-700">{{$fileCount}}</span>
                                                <span>تسخيرة</span>
                                            </div>
                                        </div>
                                        <div class="self-end">
                                            <button type="button" wire:click="clearFile" class="px-4 py-2 text-base rounded-lg shadow-md border border-red-400 font-semibold text-red-500 ring-red-400 hover:bg-red-50 hover:ring-2 hover:ring-red-400 hover:ring-offset-2">
                                                إختيار ملف آخر
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="px-6 py-4  cursor-pointer " onclick="document.getElementById('selectFile').click();">
                                <div class="flex items-start space-x-4 px-6 py-4 border-4 border-dashed border-gray-300">
                                <div class="w-24 h-24 bg-gray-300">
                                    <svg wire:loading wire:target="file" type="button" class="animate-spin h-full w-full p-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col self-stretch items-center justify-center flex-grow space-y-2">
                                    <div class="uppercase text-xl font-semibold tracking-wider text-gray-500">
                                        لم تقم بإختيار أي ملف بعد
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </form>
                </div>
            </main>
{{--            <footer class="flex  items-center justify-end px-6 py-4 bg-gray-50">--}}
{{--                <button wire:click="save" type="button" class="px-4 py-2 bg-gray-600 border rounded-md text-gray-50 hover:text-white hover:bg-gray-700">--}}
{{--                    حفظ المعلومات--}}
{{--                </button>--}}
{{--            </footer>--}}
        </div>

    </div>

</div>
