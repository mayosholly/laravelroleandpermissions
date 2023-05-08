
<template>
    <Head title="Blog Create" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Blog Create
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                            <div class="mb-6">
                                <label
                                    for="Title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >Title</label
                                >
                                <input
                                    type="text"
                                    name="title"
                                    v-model="form.title"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""
                                />
                                <div v-if="errors.title"> {{ errors.title }} </div>

                            </div>
                            <div class="mb-6">
                                <label
                                    for="Image"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >Image</label
                                >
                                <input
                                    type="file"
                                    name="image"
                                    @input="form.image = $event.target.files[0]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""
                                />
                                <div v-if="errors.image"> {{ errors.image }} </div>
                            </div>
                            <button
                                type="submit"
                                class="text-white bg-blue-700  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 "

                            >
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
import BreezeAuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import { useForm } from "@inertiajs/vue3";
export default{
    components : {
        BreezeAuthenticatedLayout,
    },
    data() {
        return {
            form: useForm({
                title: null,
                image: null
            })
        }
    },
    props: {
    errors: Object,
  },
    methods: {
        handleSubmit(){
            // console.log("submit");
            this.form.post(route('posts.store'))
        }
    },
}
</script>
