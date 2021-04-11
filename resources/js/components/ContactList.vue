<template>
    <div>
        <div>
            <div class="py-4 text-base leading-6 space-y-4 text-darkgrey sm:text-lg sm:leading-7">
                <form class="w-full relative">
                    <svg width="20" height="20" fill="currentColor" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-dovegrey">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                    </svg>

                    <input v-model="searchQuery" class="focus:border-gray-300 focus:ring-1 focus:ring-gray-300 focus:outline-none w-full text-md placeholder-gray-400 border border-gray-200 rounded-md py-2 pl-10" type="text" aria-label="Search contacts" placeholder="Search contacts" />
                </form>
            </div>
        </div>
        <div class="relative divide-y divide-gray-200 bg-gray-100 rounded-md p-2 min-h-12" v-if="contacts.length || isLoading">

            <contact-list-item v-for="contact in contacts" :key="contact.id" :contact="contact" @click="showContactDetail(contact.id)"></contact-list-item>

            <transition name="fade">
                <div class="bg-darkgrey bg-opacity-90 rounded-md absolute top-0 bottom-0 left-0 right-0 flex" v-if="isLoading">
                    <div class="self-center text-center m-2 p-8 flex-grow text-white text-1xl">Loading...</div>
                </div>
            </transition>

        </div>

        <transition name="fade">
            <div class="bg-orange text-white p-2 m-2 text-center rounded-md" v-if="error && !isLoading">{{error}}</div>
        </transition>

        <transition name="fade">
            <div class="bg-indigo text-white p-2 m-2 text-center rounded-md" v-if="searchQuery && !isLoading && contactCount == 0">No contacts found</div>
        </transition>

        <div v-if="contacts.length" class="bg-gray-100 rounded-md mt-2 p-2 flex flex-wrap-reverse flex-col md:flex-row justify-between">
            <div class="md:m-0 md:mr-2 mb-2 mt-2 text-center self-center">
                Show
                <select class="p-2 rounded-md" v-model="displayCount">
                    <option v-for="count in displayCountOptions" :key="count" :value="count">{{count}}</option>
                </select>
                of {{contactCount}} contacts
            </div>
            <div v-if="contactCount > displayCount" class="p-2 text-center">
                <button v-if="pageNo != 1" @click="loadPage(this.pageNo - 1)" class="text-indigo bg-white p-2 px-4 rounded-md hover:bg-darkgrey hover:text-white mr-2">&lt;</button>
                <button v-for="page in paginationArray" :key="page.pageNo" @click="page.pageNo != false && loadPage(page.pageNo)" :class="paginationClass(page)" class="p-2 px-4 rounded-md mr-2">{{(page.pageNo ? page.pageNo : '...')}}</button>
                <button v-if="pageNo != pageCount" @click="loadPage(this.pageNo + 1)" class="text-indigo bg-white p-2 px-4 rounded-md hover:bg-darkgrey hover:text-white">&gt;</button>
            </div>
        </div>
    </div>
    <contact-detail ref="contactDetail"></contact-detail>
</template>

<script>
import ContactListItem from './ContactListItem.vue'
import ContactDetail from './ContactDetail.vue'

export default {
    components: {
        ContactListItem,
        ContactDetail
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
            isLoading: false,
            error: ''
        };
    },
    methods: {
        loadListData() {
            this.isLoading = true
            this.error = ''
            return axios.get(`/contacts?query=${this.searchQuery}&per_page=${this.displayCount}&page=${this.pageNo}`)
        },
        async loadPage(pageNumber) {

            try {
                this.pageNo = pageNumber
                const response = await this.loadListData()

                if(response.data.code == 200) {
                    if(response.data.meta.result_count > 0) {
                        this.contacts = response.data.contacts
                    } else {
                        this.contacts = []
                    }
                    this.meta = response.data.meta
                } else {
                    this.error = response.data.error
                }
                this.isLoading = false
            } catch (ex) {
                this.error = 'Unfortunately an error occured loading contact details. Please refresh the page and try again.'
                this.isLoading = false
            }
        },
        paginationClass(page) {
            return {
                'bg-indigo text-white hover:bg-darkgrey hover:text-white ': page.currentPage, 
                'text-indigo bg-white hover:bg-darkgrey hover:text-white ': !page.currentPage && page.pageNo, 
                'text-darkgrey bg-white ': !page.currentPage && !page.pageNo
            }
        },
        showContactDetail(contactId) {
            this.$refs.contactDetail.showContactDetail(contactId)
        }
    },
    computed: {
        contactCount() {
            return this.meta.result_count;
        },
        pageCount() {
            return Math.ceil(this.contactCount / this.displayCount)
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

            // Although this is setup in the loadPage function we add a delay after each key press before we fire off
            // the request so not to send off too many requests while a person is typing
            this.isLoading = true

            this.searchTimeout = setTimeout(function(scope) {
                scope.loadPage(1)
            }, 500, this);
        },
        displayCount() {
            this.loadPage(1)
        }

    }
    };
</script>
