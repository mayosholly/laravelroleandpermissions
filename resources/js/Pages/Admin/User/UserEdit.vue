<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import Table from '@/Components/Table.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import { onMounted, watch } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Multiselect from 'vue-multiselect'
// import Multiselect from '@vueform/multiselect';



const props = defineProps({
    user : {
        type: Object,
        required: true
    },
    roles : Array,
    permissions : Array,

})

const form = useForm({
    name: props.user?.name,
    email: props.user?.email,
    roles: [],
    permissions: [],

});

const submit = () => {
    form.put(route('users.update', props.user))
};
onMounted(() => {
    // console.log(props.user.roles);
    form.permissions = props.user?.permissions
    form.roles = props.user?.roles
});

watch(
    () => props.user,
    () => {
        form.roles = props.user?.roles,
        form.permissions = props.user?.permissions

    }
)


</script>

<template>
    <AdminLayout>
        <Head title="Register" />
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
             <Link :href="route('users.index')" class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">Back</Link>

            </div>
            </div>
        <div class="max-w-md mx-auto mt-6 p-6 bg-slate-100">
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="roles" value="Roles" />
                <Multiselect
                  v-model="form.roles"
                  :options="roles"
                  :multiple="true"
                  :close-on-select="true"
                 placeholder="Pick some"
                 label="name"
                  track-by="id"
        />
            </div>



            <div class="mt-4">
                <InputLabel for="permissions" value="Permissions" />
                <Multiselect
                  v-model="form.permissions"
                  :options="permissions"
                  :multiple="true"
                  :close-on-select="true"
                 placeholder="Pick some"
                 label="name"
                  track-by="id"
        />
            </div>



            <div class="flex items-center mt-4">

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Update User
                </PrimaryButton>

            </div>
        </form>

        <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-semibold text-indigo-700">Permissions</h1>
            <div class="bg-white">
            <Table>
              <template #header>

                  <TableRow>
                      <TableHeaderCell>ID</TableHeaderCell>
                      <TableHeaderCell>Permissions</TableHeaderCell>
                      <TableHeaderCell>Action</TableHeaderCell>
                  </TableRow>

              </template>
              <template #default>
                  <TableRow v-for="userPermission in user.permissions" :key="userPermission.id" class="border-b">
                      <TableDataCell>{{ userPermission.id }}</TableDataCell>
                      <TableDataCell>{{ userPermission.name }}</TableDataCell>
                      <TableDataCell class="space-x-4">
                          <Link
                          :href="route('users.permissions.destroy', [user, userPermission])"
                          preserve-scroll method="DELETE" as="button" class="text-red-400 hover:text-red-600">Revoke</Link>
                      </TableDataCell>
                  </TableRow>
              </template>
            </Table>
        </div>
          </div>



          <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-semibold text-indigo-700">Roles</h1>
            <div class="bg-white">
            <Table>
              <template #header>

                  <TableRow>
                      <TableHeaderCell>ID</TableHeaderCell>
                      <TableHeaderCell>Roles</TableHeaderCell>
                      <TableHeaderCell>Action</TableHeaderCell>
                  </TableRow>

              </template>
              <template #default>
                  <TableRow v-for="userRole in user.roles" :key="userRole.id" class="border-b">
                      <TableDataCell>{{ userRole.id }}</TableDataCell>
                      <TableDataCell>{{ userRole.name }}</TableDataCell>
                      <TableDataCell class="space-x-4">
                          <Link
                        preserve-scroll :href="route('users.roles.destroy', [user, userRole])"
                           method="DELETE" as="button" class="text-red-400 hover:text-red-600">Revoke</Link>
                      </TableDataCell>
                  </TableRow>
              </template>
            </Table>
        </div>
          </div>

    </div>
    </AdminLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
<!-- <style src="@vueform/multiselect/themes/default.css"></style> -->
