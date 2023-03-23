<template lang="html">
    <div class="card-title">
        <div class="shadow-bg">
            <h4 class="card-title-text ai-flex-end">
                <slot></slot>
            </h4>
        </div>
    </div>
</template>

<script>
export default {
}
</script>

<style lang="css">

.layout-card .card-title {
    height: 176px;
    padding: 0;
}

.layout-card .card-title .shadow-bg {
    background-color: rgba(0,0,0,.25);
    height: 100%;
    width:100%;
    padding: 16px 18px;
    display: flex;
    box-sizing: border-box;
}

.layout-card .card-title-text {    
    color: var(--color-text-alt);
}

</style>
