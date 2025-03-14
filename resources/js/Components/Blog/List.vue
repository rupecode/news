<script setup>
    import {router} from "@inertiajs/vue3";

    const props = defineProps({
        news : {
            type: Array,
        },
        base : {
            type: String,
        },
    });

    function deleteItem(e, id) {
        if(!confirm('Delete record?')) {
            return;
        }

        const url = route(props.base + '.delete', {'id': id});
        axios.delete(url).finally(function () {
            router.visit(route(props.base + '.index'));
        }).catch(error => {
            if (error.response.status === 403) {
                alert(error.response.data.message);
            }
        });
    }
</script>

<template>
    <div v-for="item in news">
        <div>{{ item.title }}</div>
        <div>{{ item.description }} <a :href="route(base  + '.show', {'id': item.id})">...></a></div>
        <div>{{ item.owner.name }}</div>
        <div>
            <a v-on:click="deleteItem($event, item.id)" data-href="">Delete</a></div>

        <hr/>
    </div>
</template>
