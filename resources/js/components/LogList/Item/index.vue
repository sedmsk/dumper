<template>
    <div class="card mt-3">
        <div class="card-header">
            {{ log.timestamp | date }}
            <div class="pull-right">
                {{ log.tags | list }}
            </div>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item" v-append="output"></li>
        </ul>
    </div>
</template>
<script>
    import Append from "vue-append";
    import Header from "./Header";
    import Vue from "vue";

    Vue.use(Append);

    export default {
        name: "Item",
        props: {
            log: {
                required: true,
            }
        },
        filters: {
            date(timestamp) {
                let date = new Date(parseInt(timestamp));

                return date.getFullYear() + '.'
                    + ((date.getMonth() < 9) ? '0' : '') + (date.getMonth() + 1) + '.'
                    + ((date.getDate() < 10) ? '0' : '') + date.getDate() + ' '
                    + ((date.getHours() < 10) ? '0' : '') + date.getHours() + ':'
                    + ((date.getMinutes() < 10) ? '0' : '') + date.getMinutes() + ':'
                    + ((date.getSeconds() < 10) ? '0' : '') + date.getSeconds()
                    ;
            },
            list(list) {
                return list
                    .map(function (item) {
                        return "#" + item;
                    })
                    .join(' ');
            },
        },
        computed: {
            output() {
                console.log(this.log);
                return atob(this.log.output);
            },
        },
        components: {
            Header,
        },
    }
</script>
