<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Address Book</title>

    <link href="/css/app.css" rel="stylesheet">

</head>

<body class="min-h-screen bg-gray-100 py-6 sm:py-12 flex flex-col justify-center">
    <div class="py-6" id="addressbook">
        <div class="relative py-3 lg:w-1/2 md:w-2/3 sm:w-3/4 min-w-max sm:max-w-xl lg:max-w-3xl sm:mx-auto">
            <div class="absolute inset-0 bg-gradient-to-b from-yellow-400 to-yellow-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
            <div class="relative px-4 py-6 bg-white shadow-lg sm:rounded-3xl sm:p-10">
                <div class="mx-auto">
                    <div>
                        <div class="py-4 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <form class="w-full relative">
                                <svg width="20" height="20" fill="currentColor" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                                </svg>
                                <input class="focus:border-gray-300 focus:ring-1 focus:ring-gray-300 focus:outline-none w-full text-md placeholder-gray-400 border border-gray-200 rounded-md py-2 pl-10" type="text" aria-label="Search contacts" placeholder="Search contacts" />

                            </form>
                        </div>
                    </div>
                    <contact-list></contact-list>

                </div>
            </div>
        </div>
    </div>

    <div class="hidden bg-opacity-90 bg-gray-900 fixed left-0 top-0 w-screen h-screen flex flex-col justify-center">
        <div class="bg-white rounded-lg w-5/6 md:w-2/3 lg:w-1/2 mx-auto p-6">
            <div class="flex">
                <img src="https://d2oqjddkfv895o.cloudfront.net/2mCEi8cf/addressbook/contacts/120_rjgZKtQA_thumb.jpg" alt="" class="w-16 h-16 rounded-full mr-2 bg-gray-100">
                <div class="flex-grow">
                    <span class="text-lg block">Aled Parry <span class="text-sm">(Mr Aled Wyn Parry)</span></span>
                    <span class="text-sm block">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        aledparry@audaciouschurch.com
                    </span>
                    <span class="text-sm block">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        0788 188 3229
                    </span>
                </div>
            </div>
            <div class="flex flex-col md:flex-row">
                <div class="p-4 bg-gray-100 rounded-md mb-2 mt-2 md:m-0 md:mr-2">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        17th April 1991 (Age 29)
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        Production Facilitator at Audacious
                    </div>

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Married to Emily Parry
                    </div>
                </div>
                <div class="bg-gray-100 p-4 rounded-md whitespace-pre-line">4 Cromarty Avenue
                    Chadderton
                    Oldham
                    OL9 8AW
                </div>
            </div>
        </div>
    </div>
</body>
<script src="/js/app.js" type="text/javascript"></script>

</html>