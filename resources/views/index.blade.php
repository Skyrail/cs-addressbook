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
                    <contact-list></contact-list>

                </div>
            </div>
        </div>
    </div>

</body>
<script src="/js/app.js" type="text/javascript"></script>

</html>