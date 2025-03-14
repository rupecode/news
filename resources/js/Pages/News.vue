<script setup>
import { reactive, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import List from '@/Components/Blog/List.vue';
import { router } from '@inertiajs/vue3'


const errors = ref({})
const success = ref('')

const form = reactive({
    title: '',
    description: '',
    text: '',
});

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    news : {
        type: Object
    },
});

function submit() {
    axios.post(route('news.store'), form)
        .then(response => {
            success.value = response.data.message;
            router.visit(route('news.index'));

        })
        .catch(error => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        })
}
</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                News
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <List :news="news.data" :base="'news'"/>
            </div>
        </div>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <span class="text-green-600" v-if="success">{{ success }}</span>

            <form v-else class="" @submit.prevent="submit" novalidate>
                <div class="flex flex-col space-y-2">
                    <label>Title</label>
                    <input type="text" class="rounded" v-model="form.title">
                    <span class="text-red-600" v-if="errors?.title">{{ errors.title[0] }}</span>
                </div>
                <div class="flex flex-col space-y-2">
                    <label>Description</label>
                    <input type="text" class="rounded" v-model="form.description">
                    <span class="text-red-600" v-if="errors?.description">{{ errors.description[0] }}</span>
                </div>
                <div class="flex flex-col space-y-2">
                    <label>Text</label>
                    <textarea class="rounded" v-model="form.text"></textarea>
                    <span class="text-red-600" v-if="errors?.text">{{ errors.text[0] }}</span>
                </div>

                <button class="bg-gray-500 text-white rounded px-3 py-2">
                    Create
                </button>
            </form>
        </div>
    </AppLayout>
</template>
