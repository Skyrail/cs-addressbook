<template>
<div>
    <div>
        <div class="py-4 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
            <form class="w-full relative">
                <svg width="20" height="20" fill="currentColor" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                </svg>

                <input v-model="searchQuery" class="focus:border-gray-300 focus:ring-1 focus:ring-gray-300 focus:outline-none w-full text-md placeholder-gray-400 border border-gray-200 rounded-md py-2 pl-10" type="text" aria-label="Search contacts" placeholder="Search contacts" />
            </form>
        </div>
    </div>
    <div class="divide-y divide-gray-200 bg-gray-100 rounded-md p-2" v-if="contacts.length">

        <contact-list-item v-for="contact in contacts" :key="contact.id" :contact="contact"></contact-list-item>
    
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
                <a href="#" class="text-yellow-600 bg-white p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white mr-2">Prev</a>
                <a href="#" class="text-white bg-yellow-600 p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white mr-2">1</a>
                <a href="#" class="text-yellow-600 bg-white p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white mr-2">2</a>
                <span class="text-gray-600 bg-white p-2 px-4 rounded-md mr-2">...</span>
                <a href="#" class="text-yellow-600 bg-white p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white mr-2">5</a>
                <a href="#" class="text-yellow-600 bg-white p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white mr-2">6</a>
                <a href="#" class="text-yellow-600 bg-white p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white">Next</a>
            </div>
        </div>
    </div>
</template>

<script>
import ContactListItem from './ContactListItem.vue'

export default {
    components: {
        ContactListItem
    },
    data() {
        return {
            contacts: [],
            pageNo: 1,
            perPage: 5,
            perPageOptions: [5, 10, 25],
            searchQuery: "",
            searchTimeout: null
        };
    },
    computed: {
        contactCount() {
            return this.contacts.length;
        },
    },
    watch: {
        searchQuery(query) {
            if(query == '') {
                return;
            }

            clearTimeout(this.searchTimeout)

            this.searchTimeout = setTimeout(function(scope) {
                axios.get(`/api/contacts?query=${query}`).then(response => (scope.contacts = response.data.contacts))
            }, 500, this);
            //TODO: get data return - update contacts list
            //TODO: using returned data update the contact count
            //TODO: using returned data update the page number, number of pages etc.
        }
    }
    };
</script>
