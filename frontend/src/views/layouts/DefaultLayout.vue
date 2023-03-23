<template>
    <div class="layout__container has-scrolling-header">
        <div class="layout">
            <header-box></header-box>
            <main class="layout__content">
                <slot></slot>
                <notifications group="foo" />
            </main>
        </div>
    </div>
</template>

<script>
import HeaderBox from "@/views/default/Header";

export default {
    components: {
        HeaderBox,
    }
};
</script>
