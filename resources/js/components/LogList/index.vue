<template>
    <div class="container">
        <item v-for="log in logs" :key="log.did" :log="log"></item>
    </div>
</template>

<script>
    import Item from "./Item"

    export default {
        name: "LogList",
        props: {
            logs: {
                required: true,
            }
        },
        components: {
            Item
        }
    }
</script>
