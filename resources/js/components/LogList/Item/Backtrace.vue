<template>
    <table class="table">
        <thead v-if="listFirst">
        <tr v-for="item in listFirst">
            <th scope="col">
                <i v-if="listOther.length" class="fa fa-fw" :class="[ showBacktraceIcon ]"
                   @click="toggleBacktraceIcon"></i>
            </th>
            <th scope="col" class="path">
                <a v-if="pattern" :href="link(item)">{{ item.file + ":" + item.line }}</a>
                <span v-else>{{ item.file + ":" + item.line }}</span>
            </th>
            <th scope="col">
                {{ method(item) }}
            </th>
        </tr>
        </thead>
        <tbody v-if="listOther && showBacktrace">
        <tr v-for="item in listOther">
            <th scope="col">
            </th>
            <td scope="col">
                <a v-if="pattern" :href="link(item)">{{ item.file + ":" + item.line }}</a>
                <span v-else>{{ item.file + ":" + item.line }}</span>
            </td>
            <td scope="col">
                {{ method(item) }}
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: "Backtrace",
        props: {
            list: {
                required: true,
            },
        },
        data() {
            return {
                pattern: "http://localhost:63342/api/file?file=/Users/Shared/Projects/SEDv1-MSK%f&line=%l",
                showBacktrace: false,
            };
        },
        methods: {
            link(item) {
                return this.pattern
                    .replace("%f", item.file.replace(/(?:\/[^\/]+){3}(.*)/, "$1"))
                    .replace("%l", item.line);
            },
            method(item) {
                return (item.class || "") + (item.type || "") + (item.function || "") + "()";
            },
            toggleBacktraceIcon() {
                this.showBacktrace = !this.showBacktrace;
            },
        },
        computed: {
            listFirst() {
                return [this.list[0]] || [];
            },
            listOther() {
                return this.list.slice(1) || [];
            },
            showBacktraceIcon() {
                return this.showBacktrace ? "fa-minus" : "fa-plus";
            },
        },
    }
</script>

<style lang="stylus" scoped>
    table.table {
        font: 12px "Fira Code", Monaco, Consolas, monospace;
        margin-bottom: -1px;

        td, th {
            &:first-child {
                width: 10px;
            }
        }
        .path {
            width: 100px;
        }
    }
</style>
