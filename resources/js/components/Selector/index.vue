<template>
    <div class="form-control mr-sm-2 dropdown" :class="{ 'show' : show }">
        <span v-for="tag in list" class="badge badge-secondary">
            #{{ tag }}
            <!--<span aria-hidden="true">&times;</span>-->
        </span>
        <input type="text">
        <div class="dropdown-menu" :class="{ 'show' : show }">
            <a class="dropdown-item" @click="unselectTag">Action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" @click="selectTag">Action</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Selector",
        props: {
            list: {
                type: Array,
            },
        },
        data() {
            return {
                show: false,
            };
        },
        methods: {
            selectTag() {

            },
            unselectTag() {

            },
        },
    }
</script>

<style lang="stylus" scoped>
    input {
        outline: none;
        border: none;
    }

    .dropdown {
        &-menu {
            width: 100%;
        }
    }
</style>
