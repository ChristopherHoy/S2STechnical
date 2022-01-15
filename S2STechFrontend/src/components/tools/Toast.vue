<template>
    <teleport :to="'body'">
        <div class="fixed right-4 top-4 w-72 p-2 z-50">

            <div v-for="(item, index) in toasts" :key="index" @hover="delay">
                <div :class="{
                    'text-white opacity-70 rounded-md shadow z-50 w-full flex items-center mb-1':true,
                    'bg-red-500':item.status === 'error',
                    'bg-orange-500':item.status === 'warning',
                    'bg-green-500':item.status === 'success'
                }">
                    <div class="p-2 text-sm text-white flex-grow">{{item.message}}</div>
                    <button class="p-2 text-2xl transition transform duration-150 hover:scale-125 text-gray-600 flex" @click="close(index)">x</button>
                </div>
            </div>

        </div>
    </teleport>
</template>

<script>


export default {
    name: "Toast",

    data: function data() {
        return {
            toasts: [],
        }
    },

    mounted() {
        window.addEventListener('toast', (data) => {
            this.toasts.push({
                message: data.detail.message,
                status: data.detail.status
            });

            setTimeout(() => {
                this.toasts.splice(0, 1);
            }, 1500)
        })
    },

    methods: {
        close(index) {
            this.toasts.splice(index, 1)
        },
    },
}

</script>
