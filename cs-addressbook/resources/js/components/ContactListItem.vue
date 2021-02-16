<template>
    <div class="flex items-center text-black p-4 hover:bg-white">
        <img src="https://d2oqjddkfv895o.cloudfront.net/2mCEi8cf/addressbook/contacts/120_rjgZKtQA_thumb.jpg" alt="" class="w-6 h-6 rounded-full mr-2 bg-gray-100">
        {{ contact.first_name }}
    </div>
</template>

<script>
    export default {
        props: {
            contact: {
                required: true,
                type: Object
            }
        }
    }
</script>
