<template>
    <transition name="fade">
        <div class="flex items-center text-black p-4 hover:bg-white cursor-pointer">
            <img :src="contact.images.thumb.url" alt="" class="w-6 h-6 rounded-full mr-2 bg-gray-100">
            {{ contact.first_name }} {{ contact.last_name }}
        </div>
    </transition>
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
