
<template>
    <Head title="Blog Create" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Blog Index
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                      <table>
                        <thead>
                        <tr>
                            <th>N ame</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="post in posts">
                            <td>{{ post.title }}</td>
                            <td><img :src="post.image" height="50" width="50" alt="no image"></td>
                            <td>
                                <!-- <Link :href="`/posts/${post.id}/edit`">Edit</Link> -->
                                <Link :href="route('posts.edit', post)">Edit</Link>
                                <!-- <Link :href="route('posts.destroy', post)" method="delete" as="button" type="button">Delete</Link> -->
                                <Link :href="route('posts.destroy', post)"  @click="handleDelete(post)">Delete</Link>
                            </td>
                        </tr>
                    </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
import BreezeAuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import { Head,Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia"

export default{
    components : {
        BreezeAuthenticatedLayout,
        Link
    },

    props: {
    errors: Object,
    posts: Object
  },
  methods: {
    handleDelete(post) {
      if (confirm(`Are you sure you want to delete ${post.title}`)) {
        Inertia.visit(route("posts.destroy", post), {
          method: "DELETE",
        });
      }
    },
  },
}
</script>
