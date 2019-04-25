<template>
    <a @click="change">
        <i class="fa fa-fw fa-lg fa-toggle-on" :class="{ 'fa-rotate-180' : !this.checked }"></i>
    </a>
</template>

<script>
    export default {
        name: "Toggle",
        model: {
            prop: "checked",
            event: "change"
        },
        props: {
            checked: Boolean,
        },
        methods: {
            change() {
                this.$emit("change", !this.checked);
            }
        }
    };
</script>

<style lang="stylus" scoped>
    a {
        cursor: pointer;

        &:hover,
        &:focus {
            .fa-toggle-on {
                color: #28a745 !important;

                &.fa-rotate-180 {
                    color: #dc3545 !important;
                }
            }
        }
    }
</style>
