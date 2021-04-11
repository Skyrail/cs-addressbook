<template>
    <div class="bg-opacity-90 bg-gray-900 fixed left-0 top-0 w-screen h-screen flex flex-col justify-center" v-if="displayContactDetail">
        <div class="bg-white rounded-lg w-5/6 md:w-2/3 lg:w-1/2 mx-auto p-6">

            <header class="flex items-center justify-between">
                <h2 class="leading-6 text-xl font-semibold text-darkgrey">Contact Detail</h2>
                <button @click="closeModal" class="hover:bg-lightblue group flex items-center rounded-md bg-indigo text-white text-sm font-medium px-4 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Close 
                </button>
            </header>

            <div v-if="isLoading">
                <!-- LOADING ICON -->
                <h3>Loading contact details...</h3>
                <img src="images/loading-icon.gif" />
            </div>

            <div v-if="error" class="bg-orange text-white w-100 rounded-md p-4 mt-2 mb-2">
                <h3 class="text-lg font-semibold">An error occured while loading the contact details</h3>
                <p class="p-2">The error returned was '{{error}}'</p>
            </div>

            <div v-if="contactIsLoaded">
                <div class="flex mt-2">
                    <img :src="contact.images.thumb.url" alt="" class="w-16 h-16 rounded-full mr-2 bg-gray-100">
                    <div class="flex-grow">
                        <span class="text-lg block">{{contact.first_name}} {{contact.last_name}}</span>
                        <span class="text-sm block" v-if="contact.email">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            {{contact.email}}
                        </span>
                        <span class="text-sm block" v-if="contact.telephone">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            {{ contact.telephone }}
                        </span>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row">
                    <div class="p-4 bg-gray-100 rounded-md mb-2 mt-2 md:m-0 md:mr-2">
                        <div v-if="contact.date_of_birth">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{contact.date_of_birth}} (Age: )
                        </div>
                        <div v-if="contact.job">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            {{contact.job}} <span v-if="contact.employer">at {{contact.employer}}</span>
                        </div>

                        <div v-if="contact.marital">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <!-- Handle marital status -->
                            {{ contact.marital }}
                        </div>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-md whitespace-pre-line">
                        {{contact.address}}
                        {{contact.address2}}
                        {{contact.address3}}
                        {{contact.city}}
                        {{contact.county}}
                        {{contact.postcode}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            contact: {},
            contactIsLoaded: false,
            isLoading: false,
            error: '',
            displayContactDetail: false
        };
    },
    methods: {
        loadContactData(contactId) {
            this.isLoading = true
            return axios.get(`/api/contact/${contactId}`)
        },
        async showContactDetail(contactId) {

            try {

                this.error = ''
                this.contactIsLoaded = false
                this.contact = {}

                const response = await this.loadContactData(contactId)

                if(response.data.code == 200) {
                    this.contact = response.data.contact
                    this.contactIsLoaded = true
                    this.isLoading = false
                } else {
                    this.error = response.data.error
                    this.isLoading = false
                }

                this.displayContactDetail = true
            } catch (ex) {
                console.log(ex)
            }
        },
        openModal() {
            this.displayContactDetail = true
        },
        closeModal() {
            this.displayContactDetail = false
        }    
    },
};
</script>
