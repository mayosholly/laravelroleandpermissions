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
import { usePermission } from '@/composables/permissions';

defineProps([
    'products'
])

const form = useForm({})

const { hasPermission } = usePermission();

const showConfirmDeleteProductModal = ref(false)

const confirmDeleteProduct = () => {
    // console.log("hlll");
    showConfirmDeleteProductModal.value = true
}

const closeModal = () => {
    showConfirmDeleteProductModal.value = false
}

const deleteProduct = (id) => {
    form.delete(route('products.destroy', id), {
        onSuccess: () => closeModal()
    })
}
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
        </template>

        <div class="max-w-7xl mx-auto py-4">
           <div class="flex justify-between">

            <template v-if="hasPermission('create product')">
            <Link :href="route('products.create')" class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">New Product</Link>
            </template>

            <h1>Product Index</h1>
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
                    <TableRow v-for="product in products" :key="product.id" class="border-b">
                        <TableDataCell>{{ product.id }}</TableDataCell>
                        <TableDataCell>{{ product.name }}</TableDataCell>
                        <TableDataCell class="space-x-4">

                            <template v-if="hasPermission('edit product')">
                            <Link :href="route('products.edit', product)" class="text-green-400 hover:text-green-600">Edit</Link>
                            </template>
                            <!-- <Link :href="route('roles.destroy', role)" method="DELETE" as="button" class="text-red-400 hover:text-red-600">Delete</Link> -->

                             <template v-if="hasPermission('delete product')">
                            <button @click="confirmDeleteProduct" class="text-red-400 hover:text-red-600">Delete</button>
                             </template>
                            <Modal :show="showConfirmDeleteProductModal" @close="closeModal">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-slate-800">Are you sure you want to delete this product {{ product.name }}?</h2>
                                    <div class="mt-6 flex space-x-4">
                                        <DangerButton @click="deleteProduct(product.id)">Delete</DangerButton>
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
