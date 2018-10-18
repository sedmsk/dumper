<template>
    <div class="pre-loader container-fluid h-100" :class="{ 'd-none': ready }">
        <div class="row h-100 justify-content-center align-items-center">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PreLoader',
        props: {
            ready: {
                type: Boolean,
                required: true,
            }
        }
    }
</script>
