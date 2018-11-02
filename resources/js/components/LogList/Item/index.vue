<template>
    <div class="card mt-3">
        <div class="card-header" @dblclick="toggleCollapse">
            {{ log.timestamp | date }}
            <div class="pull-right">
                {{ log.tags | list }}
                <i class="fa fa-fw fa-lg" @click="toggleCollapse" :class="[ toggleCollapseIcon ]"></i>
            </div>
        </div>
        <backtrace :list="log.backtrace"></backtrace>
        <ul class="list-group list-group-flush">
            <li class="list-group-item" v-show="!collapse" v-append="output"></li>
        </ul>
    </div>
</template>
<script>
    import Append from "vue-append";
    import Backtrace from "./Backtrace";
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
        data() {
            return {
                collapse: false,
            };
        },
        methods: {
            toggleCollapse() {
                this.collapse = !this.collapse;
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
            toggleCollapseIcon() {
                return this.collapse ? 'fa-window-maximize' : 'fa-window-minimize';
            }
        },
        components: {
            Backtrace,
            Header,
        },
    }
</script>

<style lang="stylus">
    div.card ul.list-group li.list-group-item pre.sf-dump * {
        font-family: "Fira Code", Monaco, Consolas, monospace !important;
        font-size: 13px !important;
    }
</style>
