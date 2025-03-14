<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import List from '@/Components/Blog/List.vue';
    import Item from "@/Components/Blog/Item.vue";
    import ItemForm from "@/Components/Blog/ItemForm.vue";

    defineProps({
        item : {
            type: Object
        },
    });
</script>


<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ item.data.title }}
            </h2>
        </template>


        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <Item :item="item.data"/>
            </div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <ItemForm :id="item.data.id" :item="item.data"/>

            </div>
        </div>
    </AppLayout>
</template>

