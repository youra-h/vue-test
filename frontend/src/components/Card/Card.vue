<template lang="html">
    <div class="layout-card shadow-2dp">
        <slot></slot>
    </div>
</template>

<script>

export default {
}
</script>


<style lang="css">
.layout-card {
    background: var(--color-bg-card);
    border-radius: var(--border-radius);
    font-size: inherit;
}
</style>
