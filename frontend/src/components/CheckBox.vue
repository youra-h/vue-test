<template lang="html">
    <div class="cmp-checkbox">
        <input class="checkbox-input" :id="name" type="checkbox" :name="name">
        <label class="checkbox-label" :for="name">
            <slot>CheckBox</slot>
        </label>
    </div>
</template>

<script>
export default {
    props: {
        name: {
            default: 'checbox1'
        }
    }
}
</script>

<style lang="css">

.cmp-checkbox .checkbox-input {
    display: none;
}

.cmp-checkbox .checkbox-label {
    display: block;
    position: relative;
    padding-left: 26px;
    cursor: pointer;
    font-size: 0.96em;
}

.cmp-checkbox .checkbox-label::before {
    content: "\e876";
    font-family: var(--font-icons);
    font-size: 15px;
    font-weight: 600;
    color: transparent;

    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    width: 16px;
    height: 16px;
    border-radius: var(--border-radius-component);
    background: #fff;
    border: 1px solid var(--color-border-component);
    left: 0;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
}

.cmp-checkbox .checkbox-input:checked + .checkbox-label::before {
    color: var(--color-text-component-alt);
}
</style>
