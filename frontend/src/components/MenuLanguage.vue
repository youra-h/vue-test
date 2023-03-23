<template lang="html">
    <div>
        <drop-down
            id = "lang"
            :items = "items"
            :defaultValue = "getCurrentLocale"
            :keyVis = "{item: true, caption: true}"
            width = "auto"
            height = "2.25em"
            :posRight = "true"
            @clickItem="clickItem($event)"
        ></drop-down>
    </div>
</template>

<script>

import DropDown from "@/components/DropDown.vue";
import Locale from "@/i18n/Locale.js";

export default {
    data() {
        return {
            items: [
                {
                    id: 'EN',
                    name: 'English'
                },
                {
                    id: 'RU',
                    name: 'Русский'
                }
            ]
        }
    },
    components: {
        DropDown
    },
    computed: {
        getCurrentLocale() {
            return this.$i18n.locale.toUpperCase();
        }
    },
    methods: {
        clickItem(value) {
            Locale.change(value.id);
        }
    }
}
</script>
