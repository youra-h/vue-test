<template lang="html">
    <row-columns :height="height">
        <column :class="['row-cmp-label']">
            <slot></slot>
        </column>
        <column cols="8">
            <slot name="cmp"></slot>
        </column>
    </row-columns>
</template>

<script>

import RowColumns from "@/components/RowColumns.vue";
import Column from "@/components/Column.vue";

export default {
    props: {
        height: {
            default: "auto"
        }
    },
    components: {
        RowColumns, Column
    }
}
</script>
