<script setup>
defineProps({
    item : {
        type: Object,
    },
});
</script>

<template>
        <div>{{ item.title }}</div>
        <div>{{ item.text }}</div>

    <div>

    </div>
</template>
