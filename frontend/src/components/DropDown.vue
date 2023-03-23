.cmp-dropdown <template>
    <div class="cmp-dropdown">
        <div @click="toggleMenu()" :style="{width: width, height: height}"
            class="cmp cmp-gray dropdown-toggle"
            :class="{'is-focus': openItems}">
            <span class="caption" :class="{'placeholder': selectEmpty}">
                {{ paintCaption }}
            </span>

            <span class="caret"></span>
        </div>

        <ul class="cmp dropdown-menu is-focus"
            :class="[posRight ? 'position-right' : 'position-left']"
            v-if="openItems">
            <li v-for="(item, index) in items" :key="index">
                <router-link
                    :to="getLink(item)"
                    href="javascript:void(0);"
                    @click.native="selectItem(item)"
                    :class="{'is-active': isActiveItem(item)}">
                        {{ paintItem(item) }}
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            openItems: false,
            placeholderText: '',

            value: {
                id: '',
                name: ''
            },
        }
    },
    props: {
        items: {
            type: [Array, Object]
            /* ['item1','item2','item3','item4']
            or
            { id: 1, name: 'item1', link: '#' },
            { id: 2, name: 'item2', link: 'login' }
            */
        },
        defaultValue: {
            type: [String, Object]
            /* = 'item1'
            or
            { id: 3 }
            or
            { name: 'item3' }
            */
        },
        placeholder: [String],
        autoClose: {
            type: [Boolean],
            default: true,
        },
        keyVis: {
            item: false,
            caption: false
        },
        width: {
            default: '100px'
        },
        height: {
            default: 'auto'
        },
        posRight: {
            type: [Boolean],
            default: false
        }
    },
    mounted() {
        if (this.defaultValue)
        {
            /*Ищем valueId,
            1 String
            2 defaultValue.id
            3 defaultValue.name
            */
            var valueId = typeof(this.defaultValue) == 'string' ? this.defaultValue : this.defaultValue.id;
            var fieldSearch= 'id';
            /*Value не найден, пробуем поискать поле Name*/
            if (typeof(valueId) == 'undefined')
            {
                valueId = this.defaultValue.name;
                fieldSearch = 'name';
            }
            //fieldSearch = name, принудительно ищем по полю Name,
            //задается в defaultValue.name
            this.items.forEach((item, i) => {
                //Если
                let id = typeof(item) == 'string' ? item : item[fieldSearch];
                if (valueId == id)
                {
                    this.setValue(item);
                    return;
                }
            });
        }

        if (this.autoClose) {
          document.addEventListener('click', this.clickHandler);
        }
    },
    beforeDestroy() {
        document.removeEventListener('click', this.clickHandler);
    },
    computed: {
        paintCaption() {
            //Нужно проверить есть ли выбранный item
            let id = this.value.id.toString();
            if (id.trim().length > 0)
            {
                //Отображать ключ вместо текста
                let field = this.keyVis.caption ? 'id' : 'name';
                return this.value[field].trim();
            }
            return this.getPlaceholder;
        },
        getPlaceholder() {
            return this.placeholder ? this.placeholder.trim() : '';
        },
        selectEmpty() {
            let id = this.value.id.toString();
            return id.trim().length == 0;
        }
    },
    methods: {
        setValue(item) {
            this.value = {
                id: this.getItemId(item),
                name:this.getItemText(item)
            };
        },
        getItemId(item) {
            return typeof(item) == 'string' ? item : item.id;
        },
        getItemText(item) {
            return typeof(item) == 'string' ? item : item.name;
        },
        paintItem(item) {
            let text = this.getItemText(item);
            return this.keyVis.item ? item.id + ' - ' + text : text;
        },
        selectItem(item) {
            this.openItems = false;
            if (this.value.id != this.getItemId(item))
            {
                this.setValue(item);
                //Передать click item
                this.$emit('clickItem', this.value);
            }
        },
        isActiveItem(item) {
            return this.value.id == this.getItemId(item);
        },
        //Возвращает ссылку на url, default="#"
        getLink(item) {
            return item.link ? {name: item.link} : '';
        },
        toggleMenu() {
            this.openItems = !this.openItems;
        },
        clickHandler(event) {
            const { target }  = event;
            const { $el } = this;
            if (!$el.contains(target)) {
                this.openItems = false;
            }
        },
    }
}
</script>

<style>
.cmp-dropdown {
    position: relative;
    vertical-align: middle;
}
.cmp-dropdown a:hover {
    text-decoration: none;
}
.cmp-dropdown .dropdown-toggle {
    padding: 4px;
    box-sizing: border-box;
    border: 0;
    white-space: nowrap;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cmp-dropdown .dropdown-toggle .caption {
    padding: 0 6px;
}

.cmp-dropdown .dropdown-toggle .caption.placeholder {
    color: var(--color-text-light--2);
}

.cmp-dropdown .dropdown-toggle .caret {
    border-top: 4px dashed;
    border-right: 4px solid transparent;
    border-left: 4px solid transparent;
    margin-right: 6px;
    color: var(--color-text-light--2);
}

.cmp-dropdown .dropdown-menu {
    position: absolute;
    top: 100%;
    margin-top: 7px;
    z-index: 1000;
    min-width: 140px;
    padding: 5px 0;
    list-style: none;
    text-align: left;
    background-color: var(--color-bg-card);
    background-clip: padding-box;
}

.cmp-dropdown .dropdown-menu.position-left {
    left: 0;
}

.cmp-dropdown .dropdown-menu.position-right {
    right: 0;
}

.cmp-dropdown .dropdown-menu > li > a {
    padding: 10px 24px;
    display: block;
    white-space: nowrap;
    text-decoration: none;
    font-weight: 400;
    color: var(--color-text-light--1);
}
.cmp-dropdown .dropdown-menu > li > a:hover, .cmp-dropdown .is-active {
    background: var(--color-bg-link);
}
.cmp-dropdown .dropdown-menu > li {
    overflow: hidden;
    width: 100%;
    position: relative;
    margin: 0;
}

.cmp-dropdown li {
    list-style: none;
}
</style>
