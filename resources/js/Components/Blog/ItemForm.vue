<script setup>
import { reactive, ref } from 'vue';
import {router} from "@inertiajs/vue3";

const errors = ref({})
const success = ref('')

const props = defineProps({
    id: {
        type: Number,
    },
    item: {
        type: Object
    },
});

const form = reactive({
    title: props.item.title,
    description: props.item.description,
    text: props.item.text,
});

function submit() {
    axios.put(route('news.update', {'id': props.id}), form)
        .then(response => {
            router.visit(route('news.show', {'id': props.id}));

        })
        .catch(error => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }

            if (error.response.status === 403) {
                alert(error.response.data.message);
            }
        })
}
</script>

<template>
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
            Save
        </button>
    </form>
</template>
