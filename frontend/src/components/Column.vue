<template lang="html">
    <div class="mdl-cell" :class="getClsCols">
        <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        cols: {
            default: 4
        }
    },
    computed: {
        getClsCols() {
            return ' mdl-cell--' + this.cols + '-col';
        }
    }
}
</script>
