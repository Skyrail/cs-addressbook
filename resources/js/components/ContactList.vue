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
        <div v-if="contacts.length" class="bg-gray-100 rounded-md mt-2 p-2 flex flex-wrap-reverse flex-col md:flex-row justify-between">
            <div class="md:m-0 mb-4 mt-2 text-center">
                Show
                <select class="p-2 rounded-md" v-model="displayCount">
                    <option value=5>5</option>
                    <option value=10>10</option>
                    <option value=25>25</option>
                </select>
                of {{contactCount}} contacts
            </div>
            <div v-if="contactCount > displayCount" class="p-2 text-center">
                <button v-if="pageNo != 1" @click="loadPage(this.pageNo - 1)" class="text-yellow-600 bg-white p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white mr-2">&lt;</button>
                <button v-for="page in paginationArray" :key="page.pageNo" @click="page.pageNo != false && loadPage(page.pageNo)" :class="paginationClass(page)" class="p-2 px-4 rounded-md mr-2">{{(page.pageNo ? page.pageNo : '...')}}</button>
                <button v-if="pageNo != pageCount" @click="loadPage(this.pageNo + 1)" class="text-yellow-600 bg-white p-2 px-4 rounded-md hover:bg-gray-700 hover:text-white">&gt;</button>
            </div>
        </div>
    </div>
</template>

<script>
import ContactListItem from './ContactListItem.vue'
import ContactListPagionation from './ContactListPagination.vue'

export default {
    components: {
        ContactListItem,
        ContactListPagionation
    },
    data() {
        return {
            contacts: [],
            meta: [],
            pageNo: 1,
            displayCount: 5,
            displayCountOptions: [5, 10, 25],
            searchQuery: "",
            searchTimeout: null,
        };
    },
    methods: {
        loadData() {
            axios.get(`/api/contacts?query=${this.searchQuery}&per_page=${this.displayCount}&page=${this.pageNo}`).then(response => (this.contacts = response.data.contacts, this.meta = response.data.meta))
        },
        loadPage(pageNumber) {
            this.pageNo = pageNumber
            this.loadData()
        },
        paginationClass(page) {
            return {
                'bg-yellow-600 text-white hover:bg-gray-700 hover:text-white ': page.currentPage, 
                'text-yellow-600 bg-white hover:bg-gray-700 hover:text-white ': !page.currentPage && page.pageNo, 
                'text-gray-600 bg-white ': !page.currentPage && !page.pageNo
            }
        }
    },
    computed: {
        contactCount() {
            return this.meta.result_count;
        },
        pageCount() {
            return Math.ceil(this.contactCount / this.displayCount)
        },
        nextPage() {
            nextPage = this.pageNo + 1
            return (nextPage <= this.pageCount) ? nextPage : this.pageCount 
        },
        previousPage() {
            previousPage = this.pageNo - 1
            return (previousPage > 0) ? previousPage : 0
        },
        paginationArray() {

            if(this.pageCount == 1) {
                return []
            }

            var paginationButtons = []

            if(this.pageCount > 1 && this.pageCount <= 5) {
                for(let page = 1; page <= this.pageCount; page++) {

                    let paginationButton = {
                        pageNo: page,
                        currentPage: ((this.pageNo == page) ? true : false)
                    }
                    
                    paginationButtons.push(paginationButton)
                } 
            }

            if(this.pageCount > 5) {

                // The first button is always the first page
                paginationButtons.push({
                    pageNo: 1,
                    currentPage: (this.pageNo == 1) ? true : false
                })

                if(this.pageNo > 3) {
                    // Add a spacer button between first page and the current set of pages
                    paginationButtons.push({
                        pageNo: false,
                        currentPage: false
                    })
                }

                var paginationButtonStart = 2
                var paginationButtonEnd = 3

                if(this.pageNo >= 3 && this.pageNo <= (this.pageCount - 2)) {
                    paginationButtonStart = this.pageNo - 1
                    paginationButtonEnd = this.pageNo + 1
                } else if(this.pageNo > (this.pageCount - 2)) {
                    paginationButtonStart = this.pageNo - 2
                    paginationButtonEnd = this.pageCount - 1
                }

                for(let page = paginationButtonStart; page <= paginationButtonEnd; page++) {

                    let paginationButton = {
                        pageNo: page,
                        currentPage: (this.pageNo == page) ? true : false
                    }

                    paginationButtons.push(paginationButton)
                } 

                if(this.pageNo < (this.pageCount - 2)) {
                    // Add a spacer button between last page and the current set of pages
                    paginationButtons.push({
                        pageNo: false,
                        currentPage: false
                    })
                }

                // The last button is always the final page
                paginationButtons.push({
                    pageNo: this.pageCount,
                    currentPage: (this.pageNo == this.pageCount) ? true : false
                })
            }

            return paginationButtons    
        }    },
    watch: {
        searchQuery(query) {
            this.searchQuery = query

            if(query == '') {
                this.contacts = [];
                return;
            }

            clearTimeout(this.searchTimeout)

            this.searchTimeout = setTimeout(function(scope) {
                scope.loadPage(1)
            }, 500, this);
            //TODO: get data return - update contacts list
            //TODO: using returned data update the contact count
            //TODO: using returned data update the page number, number of pages etc.
        },
        displayCount() {
            this.loadPage(1)
        }

    }
    };
</script>
