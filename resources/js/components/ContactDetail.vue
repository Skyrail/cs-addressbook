<template>
    <transition name="fade">
        <div class="bg-opacity-90 bg-gray-900 fixed left-0 top-0 w-screen h-screen flex flex-col justify-center" v-if="displayContactDetail">
            <div class="bg-white sm:rounded-lg w-full sm:w-2/3 lg:w-2/5 mx-auto p-6">

                <header class="flex items-center justify-between">
                    <h2 class="leading-6 text-xl font-semibold text-darkgrey">Contact Detail</h2>
                    <button @click="closeModal" class="hover:bg-lightblue group flex items-center rounded-md bg-indigo text-white text-sm font-medium px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        Close 
                    </button>
                </header>

                <div v-if="isLoading" class="bg-indigo text-white w-100 rounded-md p-4 my-2">
                    <h3>
                    <!-- LOADING ICON -->
                    <img src="images/loading-icon.gif" class="inline-block w-8 h-8" />
                    Loading contact details...
                    </h3>
                </div>

                <div v-if="error" class="bg-orange text-white w-100 rounded-md p-4 my-2">
                    <h3 class="text-lg font-semibold">An error occured while loading the contact details</h3>
                    <p class="p-2">{{error}}</p>
                </div>

                <div v-if="contactIsLoaded">

                    <div class="bg-indigo rounded-md p-4 my-2 text-white flex">
                        <img :src="contact.images.thumb.url" alt="" class="w-16 h-16 rounded-full mr-2 bg-gray-100">
                        <div>
                            <span class="font-bold block">
                                <span v-if="contact.title">{{contact.title}}. </span>{{contact.first_name}} <span v-if="contact.last_name">{{contact.last_name}}</span>
                            </span>
                            <div class="text-sm">
                                <span class="block" v-if="contact.date_of_birth">{{contactDateOfBirth}}</span>
                                <span class="block capitalize" v-if="contact.marital">{{contact.marital}}</span>
                                <span class="block" v-if="contact.job || contact.employer">
                                    Works <span v-if="contact.job">as {{contact.job}}</span><span v-if="contact.employer"> at {{contact.employer}}</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-100 my-2 rounded-md p-2">

                        <div class="mb-2" v-if="contact.email">
                            <h3 class="text-md font-semibold">
                                E-Mail Address
                                <span v-if="contact.communication.general_email != 1" class="font-bold text-orange">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </h3>
                            <div class="p-2 my-2 rounded-md bg-indigo text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 inline-block mb-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{contact.email}}
                            </div>
                        </div>

                        <div class="my-2" v-if="contact.telephone || contact.mobile || contact.work_telephone">
                            <h3 class="text-md font-semibold">
                                Telephone Numbers
                                <span v-if="contact.communication.phone != 1" class="font-bold text-orange">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </h3>
                            <div class="p-2 my-2 rounded-md bg-indigo text-white" v-if="contact.mobile">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 inline-block mb-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                {{contact.mobile}}
                            </div>
                            <div class="p-2 my-2 rounded-md bg-indigo text-white" v-if="contact.telephone">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{contact.telephone}}
                            </div>
                            <div class="p-2 my-2 rounded-md bg-indigo text-white" v-if="contact.work_telephone">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{contact.work_telephone}}
                            </div>

                        </div>

                        <div class="my-2" v-if="contactHasAddress">
                            <h3 class="text-md font-semibold">
                                Address
                                <span v-if="contact.communication.post != 1" class="font-bold text-orange">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </h3>
                            <div class="p-2 my-2 rounded-md bg-indigo text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block align-top mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <div class="whitespace-pre-line inline-block px-2">
                                    <span v-if="contact.address" class="block">{{contact.address}}</span>
                                    <span v-if="contact.address2" class="block">{{contact.address2}}</span>
                                    <span v-if="contact.address3" class="block">{{contact.address3}}</span>
                                    <span v-if="contact.city" class="block">{{contact.city}}</span>
                                    <span v-if="contact.county" class="block">{{contact.county}}</span>
                                    <span v-if="contact.postcode" class="block">{{contact.postcode}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-2 rounded-md mt-2 text-sm bg-gray-100" v-if="contactHasOptedOut">
                        <span class="font-bold text-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <span> The user has not opted-in to this form of commmunication</span>

                    </div>

                </div>
            </div>
        </div>
    </transition>
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
            return axios.get(`/contact/${contactId}`)
        },
        async showContactDetail(contactId) {

            try {

                this.error = ''
                this.contactIsLoaded = false
                this.contact = {}

                this.displayContactDetail = true

                const response = await this.loadContactData(contactId)

                if(response.data.code == 200) {
                    this.contact = response.data.contact
                    this.contactIsLoaded = true
                    this.isLoading = false
                } else {
                    this.error = response.data.error
                    this.isLoading = false
                }

            } catch (ex) {
                this.error = 'Unfortunately an error occured loading contact details. Please refresh the page and try again.'
                this.isLoading = false
            }
        },
        openModal() {
            this.displayContactDetail = true
        },
        closeModal() {
            this.displayContactDetail = false
        }
    },
    computed: {
        contactHasAddress() {
            return (this.contact.address || this.contact.address2 || this.contact.address3 || this.contact.city || this.contact.county || this.contact.postcode)
        },
        contactHasOptedOut() {
            return (this.contact.communication.post == 0 || this.contact.communication.general_email == 0 || this.contact.communication.telephone == 0)
        },
        contactDateOfBirth() {
            if(this.contact.date_of_birth) {
                let dob = new Date(this.contact.date_of_birth)

                return dob.toLocaleDateString('en-GB', { year: 'numeric', month: 'long', day: 'numeric' })
            }
        }
    }
};
</script>
