<template>
    <teleport :to="'body'">
        <div v-if="show" class="fixed top-0 left-0 h-screen w-screen bg-opacity-70 bg-black p-6 flex items-start">
            <div class="flex-grow"></div>
            <div class="rounded-lg bg-white p-4 lg:w-7/12 sm:w-10/12 w-11/12 overflow-x-auto">
                <div class="flex items-center w-full mb-2">
                    <div class="p-1 text-xl text-gray-600 flex-grow"><slot name="header"></slot></div>
                    <button class="p-1 text-2xl transition transform duration-150 hover:scale-125 text-gray-600 " @click="$emit('close')">x</button>
                </div>
                <hr>
                <div class="p-1 mt-3">
                    <slot></slot>
                </div>

            </div>
            <div class="flex-grow"></div>
        </div>
    </teleport>
</template>

<script>


export default {
    name: "Modal",

    props: {
        show: {type: Boolean, default: false}
    }
}

</script>
