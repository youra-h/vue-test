<template lang="html">
    <div class="card-actions row-flex ai-flex-center"
        :class="{'card-border': border}">
        <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        border: {
            default: true
        }
    }
}
</script>

<style lang="css">
.layout-card .card-actions {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}
.layout-card .card-border {
    border-top: 1px solid var(--color-border-component-light);
}
</style>
