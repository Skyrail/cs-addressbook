<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Address Book</title>

    <link href="/css/app.css" rel="stylesheet">

</head>

<body class="min-h-screen bg-gray-100 py-6 sm:py-12 justify-center">
    <div class="py-6">
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
                    <div class="divide-y divide-gray-200 bg-gray-100 rounded-md p-2">
                        <div class="flex items-center text-black p-4 hover:bg-white">
                            <img src="https://d2oqjddkfv895o.cloudfront.net/2mCEi8cf/addressbook/contacts/120_rjgZKtQA_thumb.jpg" alt="" class="w-6 h-6 rounded-full mr-2 bg-gray-100">
                            Kevin Francis
                        </div>
                        <div class="flex items-center text-black p-4 hover:bg-white">
                            <img src="https://d2oqjddkfv895o.cloudfront.net/2mCEi8cf/addressbook/contacts/120_rjgZKtQA_thumb.jpg" alt="" class="w-6 h-6 rounded-full mr-2 bg-gray-100">
                            Kevin Francis
                        </div>
                        <div class="flex items-center text-black p-4 hover:bg-white">
                            <img src="https://d2oqjddkfv895o.cloudfront.net/2mCEi8cf/addressbook/contacts/120_rjgZKtQA_thumb.jpg" alt="" class="w-6 h-6 rounded-full mr-2 bg-gray-100">
                            Kevin Francis
                        </div>
                    </div>

                    <div class="bg-gray-100 rounded-md mt-2 p-2 flex flex-wrap flex-col md:flex-row justify-between">
                        <div class="md:m-0 mb-4 mt-2 text-center">
                            Show
                            <select class="p-2 rounded-md">
                                <option>5</option>
                                <option>10</option>
                                <option>25</option>
                            </select>
                            of <span class="p-2 rounded-md bg-white text-yellow-600">45</span> contacts
                        </div>
                        <div class="p-2 text-center">
                            <a href="#" class="text-yellow-600 bg-white p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white">Prev</a>
                            <a href="#" class="text-white bg-yellow-600 p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white">1</a>
                            <a href="#" class="text-yellow-600 bg-white p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white">2</a>
                            <span class="text-gray-600 bg-white p-2 px-4 rounded-md">...</span>
                            <a href="#" class="text-yellow-600 bg-white p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white">5</a>
                            <a href="#" class="text-yellow-600 bg-white p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white">6</a>
                            <a href="#" class="text-yellow-600 bg-white p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white">Next</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>