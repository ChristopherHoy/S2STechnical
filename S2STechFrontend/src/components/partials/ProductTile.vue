<template>
    <div class="border rounded-lg hover:shadow p-4 hover:scale-110 transform transition duration-150 overflow-hidden">

        <p class="text-lg mb-2 font-bold">{{productData.sku}}</p>

        <div class="w-full text-sm">
            <p><strong>Size: </strong>{{productData.attributes.size}}</p>
            <p><strong>Grams: </strong>{{productData.attributes.grams}}</p>
            <p><strong>Foo: </strong>{{productData.attributes.foo}}</p>
        </div>

        <div class="w-full flex">
            <div class="flex-grow"></div>
            <button class="rounded-md bg-red-500 text-white transition px-6 py-1 text-sm transform hover:scale-110 duration-150" @click="$emit('edit', productData)">
                Edit Product
            </button>
        </div>

    </div>
</template>

<script>
export default {
    name: "ProductTile",

    props: {
        productData: {type: Object, default: {}}
    }
}

</script>
