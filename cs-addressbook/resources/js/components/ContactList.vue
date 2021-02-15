<template>
<div>
    <div class="divide-y divide-gray-200 bg-gray-100 rounded-md p-2">
        <div v-for="contact in contacts" v-bind:key="contact.id" class="flex items-center text-black p-4 hover:bg-white">
        <img src="https://d2oqjddkfv895o.cloudfront.net/2mCEi8cf/addressbook/contacts/120_rjgZKtQA_thumb.jpg" alt="" class="w-6 h-6 rounded-full mr-2 bg-gray-100">
        {{ contact.name }}
        </div>
    </div>
        <div class="bg-gray-100 rounded-md mt-2 p-2 flex flex-wrap-reverse flex-col md:flex-row justify-between">
            <div class="md:m-0 mb-4 mt-2 text-center">
                Show
                <select class="p-2 rounded-md">
                    <option>5</option>
                    <option>10</option>
                    <option>25</option>
                </select>
                of <span class="p-2 rounded-md bg-white text-yellow-600">{{contactCount}}</span> contacts
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
</template>

<script>
export default {
  data() {
    return {
      contacts: [
        { id: 1, name: "Aled Parry" },
        { id: 2, name: "Emily Parry" },
        { id: 3, name: "Anthony Gordon" },
      ],
      pageNo: 1,
      perPage: 5,
      perPageOptions: [5, 10, 25],
    };
  },
  computed: {
    contactCount() {
      return this.contacts.length;
    },
  }
};
</script>
