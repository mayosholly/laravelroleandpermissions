<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import Table from '@/Components/Table.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue'
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
defineProps([
    'roles'
])

const form = useForm({})

const showConfirmDeleteRoleModal = ref(false)

const confirmDeleteRole = () => {
    // console.log("hlll");
    showConfirmDeleteRoleModal.value = true
}

const closeModal = () => {
    showConfirmDeleteRoleModal.value = false
}

const deleteRole = (id) => {
    form.delete(route('roles.destroy', id), {
        onSuccess: () => closeModal()
    })
}
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>

        <div class="max-w-7xl mx-auto py-4">
           <div class="flex justify-between">
            <Link :href="route('roles.create')" class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">New Role</Link>

            <h1>Roles Index</h1>
           </div>
            <div class="mt-6">
              <Table>
                <template #header>

                    <TableRow>
                        <TableHeaderCell>ID</TableHeaderCell>
                        <TableHeaderCell>Name</TableHeaderCell>
                        <TableHeaderCell>Action</TableHeaderCell>
                    </TableRow>

                </template>
                <template #default>
                    <TableRow v-for="role in roles" :key="role.id" class="border-b">
                        <TableDataCell>{{ role.id }}</TableDataCell>
                        <TableDataCell>{{ role.name }}</TableDataCell>
                        <TableDataCell class="space-x-4">
                            <Link :href="route('roles.edit', role)" class="text-green-400 hover:text-green-600">Edit</Link>
                            <!-- <Link :href="route('roles.destroy', role)" method="DELETE" as="button" class="text-red-400 hover:text-red-600">Delete</Link> -->
                            <button @click="confirmDeleteRole" class="text-red-400 hover:text-red-600">Delete</button>
                            <Modal :show="showConfirmDeleteRoleModal" @close="closeModal">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-slate-800">Are you sure you want to delete this role?</h2>
                                    <div class="mt-6 flex space-x-4">
                                        <DangerButton @click="deleteRole(role.id)">Delete</DangerButton>
                                        <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                    </div>
                                </div>
                                </Modal>
                        </TableDataCell>
                    </TableRow>
                </template>
              </Table>
            </div>
        </div>
    </AdminLayout>
</template>
