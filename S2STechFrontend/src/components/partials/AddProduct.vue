<template>
    <div class="p-2">

        <div class="flex w-full items-center mb-1">
            <label class="text-base font-bold w-36">SKU</label>
            <input :disabled="edit" class="flex-grow border rounded-md border-gray-300 px-2 outline-none focus:ring-1 focus:ring-blue-400 h-9 disabled:opacity-40" type="text" v-model="formData.sku"  @input="validate">
        </div>
        <div class="flex mb-3">
            <div class="w-36 "></div>
            <p v-if="validationMessages.sku !== ''" class="leading-3 text-sm text-red-500">{{validationMessages.sku}}</p>
        </div>

        <div class="flex w-full items-center mb-1">
            <label class="text-base font-bold w-36">Size</label>
            <select class="flex-grow border rounded-md border-gray-300 px-2 outline-none focus:ring-1 focus:ring-blue-400 h-9" v-model="formData.attributes.size"  @change="validate">
                <option value="small">Small</option>
                <option value="medium">Medium</option>
                <option value="large">Large</option>
            </select>
        </div>
        <div class="flex mb-3">
            <div class="w-36"></div>
            <p v-if="validationMessages.size !== ''" class="leading-3 text-sm text-red-500">{{validationMessages.size}}</p>
        </div>

        <div class="flex w-full items-center mb-1">
            <label class="text-base font-bold w-36">Grams</label>
            <input class="flex-grow border rounded-md border-gray-300 px-2 outline-none focus:ring-1 focus:ring-blue-400 h-9" type="text" v-model="formData.attributes.grams"  @input="validate">
        </div>
        <div class="flex mb-3">
            <div class="w-36"></div>
            <p v-if="validationMessages.grams !== ''" class="leading-3 text-sm text-red-500">{{validationMessages.grams}}</p>
        </div>

        <div class="flex w-full items-center mb-1">
            <label class="text-base font-bold w-36">Foo</label>
            <input class="flex-grow border rounded-md border-gray-300 px-2 outline-none focus:ring-1 focus:ring-blue-400 h-9" type="text" v-model="formData.attributes.foo" @input="validate">
        </div>
        <div class="flex mb-3">
            <div class="w-36"></div>
            <p v-if="validationMessages.foo !== ''" class="leading-3 text-sm text-red-500">{{validationMessages.foo}}</p>
        </div>

        <div  class="flex w-full items-center mb-2">
            <div class="flex-grow"></div>
            <button class="rounded-md bg-green-500 text-white transition px-2 py-1 transform hover:scale-110 duration-150" @click="submit">
                Submit
            </button>
        </div>

    </div>
</template>

<script>
export default {
    name: "AddProduct",

    props: {
        values: {type: Object, default: () => {return {}}},
        edit: {type: Boolean, default: false}
    },

    data: function data() {
        return {
            formData: {
                sku: '',
                attributes: {
                    size: '',
                    grams: '',
                    foo: ''
                }
            },
            validationMessages: {
                sku: '',
                size: '',
                grams: '',
                foo: ''
            },
        }
    },

    mounted() {
        if (this.values !== null) {
            this.formData = this.values;
        } else {
            this.formData = {
                sku: '',
                attributes: {
                    size: '',
                    grams: '',
                    foo: ''
                }
            }
        }
    },

    methods: {
        isEmpty(item) {
            return item === null || item === undefined || item === ''
        },

        // Ensure that grams is numeric and that all fields are provided
        validate() {

            // Validate that all required fields are provided
            let isValid = true;

            for (let key of Object.keys(this.validationMessages)) {
                if (this.isEmpty(this.formData[key]) && (this.isEmpty(this.formData.attributes) || this.isEmpty(this.formData.attributes[key]))) {
                    this.validationMessages[key] = 'Required';
                    isValid = isValid && false;
                } else {
                    this.validationMessages[key] = '';
                }
            }

            // Validate that grams is a number
            if (this.validationMessages['grams'] === '') {
                if (!/^\d+$/.test(this.formData.attributes['grams'])) {
                    this.validationMessages['grams'] = 'Must be a valid number';
                    isValid = isValid && false;
                } else {
                    this.validationMessages['grams'] = '';
                }
            }

            return isValid;
        },

        submit() {
            if (this.validate()) {
                this.$emit('submit-data', this.formData)
            }
        }
    }
}

</script>
