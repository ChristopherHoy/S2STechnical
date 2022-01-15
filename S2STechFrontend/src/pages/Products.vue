<template>
    <div class="p-6 bg-gray-50">

        <div class="w-100 shadow p-6 border bg-white rounded-lg" >
            <div class="flex pt-4 pb-6">
                <h1  class="text-3xl mx-2 text-gray-600 pb-2 flex-grow">Products</h1>
                <button class="rounded-md bg-blue-500 text-white transition px-6 py-0.5 transform whitespace-nowrap hover:scale-110 duration-150" @click="newProduct()">
                    + New Product
                </button>
            </div>

            <div  class="grid gap-4 xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 w-100 bg-white">
                <product-tile class="bg-stone-100" v-for="(item, index) of productData.data" :key="index" :product-data="item" @edit="newProduct(true, $event)"></product-tile>
            </div>
        </div>

    </div>

    <modal :show="addModal.show" @close="addModal.close()">
        <template v-slot:header>
            <h1 class="text-3xl text-gray-600">{{!addModal.edit ? 'Add Product' : 'Edit Product' }}</h1>
        </template>

        <add-product class="w-100" :values="addModal.data" @submit-data="addProduct" :edit="addModal.edit"></add-product>

    </modal>

</template>

<script>

import AddProduct from "../components/partials/AddProduct.vue"
import ProductTile from "../components/partials/ProductTile.vue"
import Modal from "../components/tools/Modal.vue"

export default {
    name: "Products",

    components: {
      AddProduct, ProductTile, Modal
    },

    data: function data() {
        return {
            productData: [],
            addModal: {
                show: false,
                data: null,
                edit: false, // Is this an edit or an add
                close: () => {
                    this.addModal.data = null;
                    this.addModal.show = false;
                }
            }
        }
    },

    mounted() {
        this.fetchProducts()
    },

    methods: {
        fetchProducts() {
            this.axios.get('/products').then((res) => {
                this.productData = res.data;
                toast.success("Success")
            }).catch((err) => {
                toast.error("ERROR: Failed to fetch products")
            })
        },

        newProduct(edit=false, data=null) {
            this.addModal.edit = edit;
            this.addModal.data = data;
            this.addModal.show = true;

        },

        addProduct(data) {
            this.axios.post('/products', data).then((res) => {
                this.fetchProducts();
                this.addModal.show = false;
                toast.success("Success")
            }).catch((err) => {
                toast.error("ERROR: Failed to add / modify product")
            })
        }
    }
}

</script>
