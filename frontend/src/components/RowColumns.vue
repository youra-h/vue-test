<template lang="html">
    <div class="item-row" :style="{height: height}">
        <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        height: {
            type: [String],
            default: '48px'
        }
    }
}
</script>

<style lang="css">
.item-row {
    box-sizing: border-box;

    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;

    -webkit-align-items: center;
        -ms-flex-align: center;
            align-items: center;

    flex-direction: row;
    flex-wrap: nowrap;
    cursor: default;
}
</style>
