<template lang="html">
    <div class="cmp-textfield">
        <div class="textfield textfield-floating-label"
            :class="{'is-invalid': isError,
                'is-dirty': isDirty,
                'is-focused': isFocused,
                'is-icon': (isIcon || property.btns)}">
            <i aria-hidden="true" class="material-icons textfield__icon"
                v-if="property.btns && property.btns.pass"
                @click="onClickIconPass()">
                {{btnsIcon.pass}}
            </i>
            <input class="textfield__input"
                :type="property.inputType"
                :id="property.name"
                :maxlength="getMaxLength"
                @input="onChange()"
                @focus="onFocused()"
                @blur="onBlur()"
                v-model="inputValue"
                :pattern="property.pattern"
                :autocomplete="property.autocomplete ? 'on' : 'off'"
            />
            <label class="textfield__placeholder"
                :for="property.name">
                {{getTranslate(property.placeHolder)}}
            </label>
        </div>
        <div class="textfield-message mdl-color-text--grey-600" v-if="isShowMessage">
            <span :class="{'__error': isInvalid}">{{getTranslate(getMessage)}}</span>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        property: {
            name: 'input1',
            label: '',
            inputType: 'text',
            placeHolder: 'Input',
            maxLength: {
                type: Number,
                default: 0
            },
            autocomplete: {
                type: Boolean,
                default: false
            },
            //or only pattern
            pattern: {
                value: '',
                /*  /[^0-9+]/  */
                error: '',
                blur: false
            },
            icon: {
                name: '',
                run: Function
                /*@click="property.icon.run(getThis())"
                run: (childCmp) => {}*/
            },
            //or only message
            message: {
                info: '',
                error: ''
            },
            btns: {
                pass: false
            }
        },
        isError: Boolean,
        translate: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {
            inputValue: '',
            isFocused: false,
            isSelfError: false,
            btnsIcon: {
                pass: 'visibility'
            }
        }
    },
    computed: {
        getMaxLength() {
            return this.property.maxLength > 0 ? this.property.maxLength : false;
        },
        isInvalid() {
            return this.isError || this.isSelfError;
        },
        getMessage() {
            if (typeof(this.property.message) == 'undefined' &&
                typeof(this.property.pattern) == 'undefined')
                return false;

            if (this.isSelfError &&
                !(this.property.pattern instanceof RegExp) &&
                this.property.pattern.error &&
                this.property.pattern.error.trim().length > 0)
                return this.property.pattern.error.trim();

            if (this.property.message &&
                typeof(this.property.message) != 'object' &&
                this.property.message.trim().length > 0)
                return this.property.message.trim();

            if (this.isError &&
                typeof(this.property.message) == 'object' &&
                this.property.message.error &&
                this.property.message.error.trim().length > 0)
                return this.property.message.error.trim();

            return this.property.message.info &&
                this.property.message.info.trim().length > 0 ? this.property.message.info.trim() : '';
        },
        isIcon() {
            return typeof(this.property.icon) == 'object';
        },
        getPattern() {
            return this.property.pattern instanceof RegExp ? this.property.pattern : this.property.pattern.value;
        },
        isDirty() {
            return (this.inputValue.trim().length > 0) ? true : false;
        },
        isShowMessage() {
            return (this.property.message && this.property.message.info.trim().length>0) ||
                (this.isError && this.property.message) ||
                (this.isSelfError && this.property.pattern);
        },
        isEmpty() {
            return this.inputValue.trim().length == 0;
        }
    },
    methods: {
        getThis() {
            return this;
        },
        getTranslate(value) {
            return value;
            // return this.translate ? this.$t(value) : value;
        },
        runPattern() {
            let rg = new RegExp(this.getPattern);
            this.isSelfError = rg.test(this.inputValue);
        },
        onChange() {
            this.$emit('on-change', this.inputValue);
            /*Проверка, проверять на pattern на событие Onchange или на onBlur*/
            if (this.property.pattern instanceof RegExp ||
                (typeof(this.property.pattern) == 'object' && !this.property.pattern.blur))
                this.runPattern();
        },
        onFocused() {
            this.isFocused = true;
        },
        onBlur() {
            this.isFocused = false;
            if (typeof(this.property.pattern) == 'object' && this.property.pattern.blur)
                this.runPattern();
        },
        /*События для кнопок*/
        onClickIconPass() {            
            if (this.property.inputType == 'text') {
                this.property.inputType = 'password';
                this.btnsIcon.pass = 'visibility';
            } else {
                this.property.inputType = 'text';
                this.btnsIcon.pass = 'visibility_off';
            }
        }
    }
}
</script>

<style type="css">
/*[TEXTFIELD COMPONENT]*/

.cmp-textfield {
    position: relative;
    display: flex;
    flex-direction: column;
}

.cmp-textfield .textfield {
    font-size: inherit;
    width: 100%;
    position: relative;
    display: inline-block;
    box-sizing: border-box;
    max-width: 100%;
    margin: 0;
    padding: 20px 0;
}

.cmp-textfield .textfield__input {
    font-size: 1.2em;
    border: none;
    border-bottom: 1px solid var(--color-border-component-light);
    display: block;
    margin: 0;
    padding: 4px 0;
    width: 100%;
    background: 0 0;
    text-align: left;
    color: inherit;
}

.cmp-textfield .textfield__placeholder {
    font-size: 0.93rem;
    color: var(--color-text-placeholder);
    bottom: 0;
    left: 0;
    right: 0;
    pointer-events: none;
    position: absolute;
    display: block;
    top: 25px;
    width: 100%;
    overflow: hidden;
    white-space: nowrap;
    text-align: left;
}

.cmp-textfield .textfield__placeholder:after {
    background-color: var(--color-text-component-alt);
    bottom: 20px;
    content: '';
    height: 2px;
    left: 45%;
    position: absolute;
    transition-duration: .2s;
    transition-timing-function: cubic-bezier(.4,0,.2,1);
    visibility: hidden;
    width: 10px;
}

.cmp-textfield .textfield-floating-label .textfield__placeholder {
    transition-duration: .2s;
    transition-timing-function: cubic-bezier(.4,0,.2,1);
}

/*[TEXTFIELD IS_DISRTY]*/


/*[TEXTFIELD IS_FOCUSED]*/

.cmp-textfield .textfield.is-focused .textfield__input {
    outline: none;
}

.cmp-textfield .textfield.is-focused .textfield__placeholder,
.cmp-textfield .textfield-floating-label.is-dirty .textfield__placeholder {
    color: var(--color-text-component-alt);
    top: 4px;
    visibility: visible;
}

.cmp-textfield .textfield.is-focused .textfield__placeholder:after {
    left: 0;
    visibility: visible;
    width: 100%;
}

/*[TEXTFIELD IS_INVALID]*/

.cmp-textfield .textfield.is-invalid .textfield__input {
    border-color: var(--color-text-error);
    box-shadow: none;
}

.cmp-textfield .textfield.is-invalid .textfield__placeholder {
    color: var(--color-text-error);
}

.cmp-textfield .textfield.is-invalid .textfield__placeholder:after {
    background-color: var(--color-text-error);
}

/*[IF ICON]*/
.cmp-textfield .is-icon.textfield {
    display: inline-flex;
}

.cmp-textfield .is-icon .textfield__input {
    padding-right: 35px;
}
.cmp-textfield .is-icon .textfield__icon {
    font-size: 1.3em;
    cursor: pointer!important;
    pointer-events: auto!important;
    right: 8px;
}

.cmp-textfield .is-icon .material-icons:hover {
    opacity: 0.7;
}

.cmp-textfield .textfield__icon {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(0,0,0,.54);
    left: initial;
    right: 12px;
    cursor: default;
    pointer-events: none;
}
/*[IF MESSAGE]*/

.cmp-textfield .textfield-message {
    position: absolute;
    top: 50px;
    line-height: 1em;
}

.cmp-textfield .textfield-message .__error {
    color: var(--color-text-error);
}

/* ОБЩИЕ */

.cmp-textfield .textfield.is-focused .textfield__placeholder,
.cmp-textfield .textfield-floating-label.is-dirty .textfield__placeholder,
.cmp-textfield .textfield-message span  {
    font-size: 0.88em;
}
</style>
