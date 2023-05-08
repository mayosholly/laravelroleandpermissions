<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import Table from '@/Components/Table.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
defineProps([
    'users'
])

const form = useForm({})

const showConfirmDeleteUserModal = ref(false)

const confirmDeleteUser = () => {
    showConfirmDeleteUserModal.value = true
}

const closeModal = () => {
    showConfirmDeleteUserModal.value = false
}

const deleteUser = (id) => {
    form.delete(route('users.destroy', id), {
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
             <Link :href="route('users.create')" class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">New User</Link>

             <h1>User Index</h1>
            </div>
            <div class="mt-6">
              <Table>
                <template #header>

                    <TableRow>
                        <TableHeaderCell>ID</TableHeaderCell>
                        <TableHeaderCell>Name</TableHeaderCell>
                        <TableHeaderCell>Email</TableHeaderCell>
                        <TableHeaderCell>Action</TableHeaderCell>
                    </TableRow>

                </template>
                <template #default>
                    <TableRow v-for="user in users" :key="user.id" class="border-b">
                        <TableDataCell>{{ user.id }}</TableDataCell>
                        <TableDataCell>{{ user.name }}</TableDataCell>
                        <TableDataCell>{{ user.email }}</TableDataCell>
                        <TableDataCell class="space-x-4">
                            <Link :href="route('users.edit', user)" class="text-green-400 hover:text-green-600">Edit</Link>
                            <!-- <Link :href="route('users.destroy', user)" method="DELETE" as="button" class="text-red-400 hover:text-red-600">Delete</Link> -->
                            <button @click="confirmDeleteUser" class="text-red-400 hover:text-red-600">Delete</button>
                            <Modal :show="showConfirmDeleteUserModal" @close="closeModal">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-slate-800">Are you sure you want to delete this user?</h2>
                                <div class="mt-6 flex space-x-4">
                                    <DangerButton @click="deleteUser(user.id)">Delete</DangerButton>
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
