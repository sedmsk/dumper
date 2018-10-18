<template>
    <div>
        Counter: {{ count }}
        <br>
        <input class="btn btn-secondary" type="button" value="Click me" @click="increment"/>
    </div>
</template>

<script>
    export default {
        name: 'MyButton',
        data() {
            return {
                count: 0
            };
        },
        methods: {
            increment() {
                ++this.count;
            }
        }
    }
</script>
